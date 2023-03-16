<?php

namespace Domains\Shared\Models\Observers;


use Domains\Shared\Models\UserBio;
use Illuminate\Support\Facades\Cache;

class UserBioObserver
{
    public function updated(UserBio $userBio): void
    {
        if ($userBio->user->role_id->isExpert()) {
            Cache::tags('users')->forget('authors');
        }
    }
}
