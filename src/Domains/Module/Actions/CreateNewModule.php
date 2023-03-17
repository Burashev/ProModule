<?php
declare(strict_types=1);

namespace Domains\Module\Actions;

use Domains\Module\DTOs\NewModuleDTO;
use Domains\Module\Models\Module;
use Domains\Shared\Models\User;
use Illuminate\Support\Facades\DB;

final class CreateNewModule
{
    public function __invoke(NewModuleDTO $newModuleDTO, ?User $user = null): Module
    {
        if (is_null($user)) $user = auth()->user();

        DB::beginTransaction();

        $module = Module::query()->make([
            'title' => $newModuleDTO->title,
            'skill_id' => $newModuleDTO->skill_id,
            'user_id' => $user->getKey()
        ]);

        $module->uploadFile($newModuleDTO->task_file);
        $module->save();

        $module->uploadMediaFiles($newModuleDTO->media_files);

        $module->tags()->attach($newModuleDTO->tag_ids);

        DB::commit();

        return $module;
    }
}
