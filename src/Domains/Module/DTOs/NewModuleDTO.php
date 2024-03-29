<?php
declare(strict_types=1);

namespace Domains\Module\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

final readonly class NewModuleDTO
{
    /**
     * @param string $title
     * @param string $skill_id
     * @param string $time
     * @param UploadedFile $task_file
     * @param array<UploadedFile> $media_files
     * @param array<string> $tag_ids
     */
    public function __construct(
        public string       $title,
        public string       $skill_id,
        public string       $time,
        public UploadedFile $task_file,
        public array        $media_files,
        public ?array       $tag_ids = null
    )
    {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(...$request->only('title', 'skill_id', 'time', 'task_file', 'media_files', 'tag_ids'));
    }
}
