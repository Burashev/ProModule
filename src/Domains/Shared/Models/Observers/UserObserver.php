<?php

namespace Domains\Shared\Models\Observers;


use Domains\Shared\Enums\RolesEnum;
use Domains\Shared\Models\User;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    private function forgetAuthorsCacheIfExpert(User $user): void
    {
        if ((int)$user->role_id === RolesEnum::EXPERT_ID->value) {
            Cache::tags('users')->forget('authors');
        }
    }

    public function created(User $user): void
    {
        $this->forgetAuthorsCacheIfExpert($user);
    }

    public function updated(User $user): void
    {
        $this->forgetAuthorsCacheIfExpert($user);
    }

    public function deleted(User $user): void
    {
        $this->forgetAuthorsCacheIfExpert($user);
    }

    public function forceDeleted(User $user): void
    {
        $this->forgetAuthorsCacheIfExpert($user);
    }
}
