<?php

namespace Domains\Shared\Models\Observers;


use Domains\Shared\Enums\RolesEnum;
use Domains\Shared\Models\UserBio;
use Illuminate\Support\Facades\Cache;

class UserBioObserver
{
    public function updated(UserBio $userBio): void
    {
        if ((int)$userBio->user->role_id === RolesEnum::EXPERT_ID->value) {
            Cache::tags('users')->forget('authors');
        }
    }
}
