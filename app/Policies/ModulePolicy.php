<?php

namespace App\Policies;

use Domains\Module\Models\Module;
use Domains\Shared\Models\User;

class ModulePolicy
{
    public function show(User $user, Module $module): bool
    {
        return
            $user->role_id->isAdministrator() ||
            $user->skills()->where('skills.id', $module->skill->id)->exists();
    }
}
