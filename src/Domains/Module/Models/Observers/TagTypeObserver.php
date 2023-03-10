<?php

namespace Domains\Module\Models\Observers;


use Domains\Module\Models\TagType;
use Illuminate\Support\Facades\Cache;

class TagTypeObserver
{
    private function forgetFilteredTagTypesCacheIfFiltered(TagType $tagType): void
    {
        if ($tagType->is_filtered === true) {
            Cache::tags('tag_types')->forget('filtered_tag_types');
        }
    }


    public function created(TagType $tagType): void
    {
        $this->forgetFilteredTagTypesCacheIfFiltered($tagType);
    }


    public function updated(TagType $tagType): void
    {
        $this->forgetFilteredTagTypesCacheIfFiltered($tagType);
    }


    public function deleted(TagType $tagType): void
    {
        $this->forgetFilteredTagTypesCacheIfFiltered($tagType);
    }


    public function forceDeleted(TagType $tagType): void
    {
        $this->forgetFilteredTagTypesCacheIfFiltered($tagType);
    }
}
