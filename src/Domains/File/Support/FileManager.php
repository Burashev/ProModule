<?php
declare(strict_types=1);

namespace Domains\File\Support;

use Domains\File\Models\File;
use Domains\File\Models\FileLink;
use Domains\Shared\Models\User;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Support\Exceptions\BusinessException;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class FileManager
{
    public Filesystem $storage;
    public User $user;

    public function __construct(?User $user = null)
    {
        $this->storage = Storage::disk('files');
        $this->user = ($user && $user->exists) ? $user : auth()->user();

        throw_if(is_null($this->user), new \DomainException('User can not be null'));
    }

    public function upload(UploadedFile $file): File|false
    {
        $extension = $file->extension();

        if (!$this->checkExtension($extension)) {
            throw new BusinessException('Загрузка файла не удалась');
        }

        $type = $file->getMimeType();
        $title = explode('.', $file->getClientOriginalName())[0];
        $size = $file->getSize();

        $path = $this->storage->putFileAs($this->generateFolderName(), $file, $this->generateFileName($extension));

        return $this->createModelRecord($title, $type, $size, $path);
    }

    public function checkExtension(string $extension): bool
    {
        if (!in_array($extension, config('file.available_extensions'))) {
            throw new BusinessException('Данное расширение файла запрещено');
        }

        return true;
    }

    public function createModelRecord($title, $type, $size, $path): File
    {
        return $this->user->files()->create(
            compact('title', 'type', 'size', 'path')
        );
    }

    public function createFileLink(File $file): string
    {
        /** @var FileLink $fileLink */
        $fileLink = $file->fileLinks()->create([
            'uuid' => Str::uuid()->toString(),
            'user_id' => $this->user->id
        ]);

        return $this->getFileLinkUrl($fileLink);
    }

    public function downloadFile(FileLink $fileLink): StreamedResponse
    {
        if ($fileLink->is_downloaded) {
            throw new BusinessException('Файл уже был скачан');
        }

        if ($this->user->getKey() !== $fileLink->user_id) {
            throw new BusinessException('Вы не являетесь автором файла');
        }

        $fileLink->update([
            'is_downloaded' => true
        ]);

        return $this->storage->download($fileLink->file->path);
    }

    public function getFileLinkUrl(FileLink $fileLink): string
    {
        return route('file.download', $fileLink);
    }

    public function generateFolderName(): string
    {
        return '';
    }

    public function generateFileName($extension): string
    {
        return Str::uuid()->toString() . "." . $extension;
    }
}
