<?php

namespace Domains\Catalog\Models\Observers;


use Domains\Catalog\Models\Skill;
use Illuminate\Support\Facades\Cache;

class SkillObserver
{
    private function forgetSkillsCache(): void
    {
        Cache::tags('skills')->forget('skills');
    }


    public function created(Skill $skill): void
    {
        $this->forgetSkillsCache();
    }


    public function updated(Skill $skill): void
    {
        $this->forgetSkillsCache();;
    }


    public function deleted(Skill $skill): void
    {
        $this->forgetSkillsCache();;
    }


    public function forceDeleted(Skill $skill): void
    {
        $this->forgetSkillsCache();;
    }
}
