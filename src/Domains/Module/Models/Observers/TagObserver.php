<?php

namespace Domains\Module\Models\Observers;


use Domains\Module\Models\Tag;
use Domains\Module\Models\TagType;
use Illuminate\Support\Facades\Cache;

class TagObserver
{
    private function forgetFilteredTagTypesCacheIfFiltered(TagType $tagType): void
    {
        if ($tagType->is_filtered === true) {
            Cache::tags('tag_types')->forget('filtered_tag_types');
        }
    }

    public function created(Tag $tag): void
    {
        $this->forgetFilteredTagTypesCacheIfFiltered($tag->tagType);
    }

    public function updated(Tag $tag): void
    {
        $this->forgetFilteredTagTypesCacheIfFiltered($tag->tagType);
    }

    public function deleted(Tag $tag): void
    {
        $this->forgetFilteredTagTypesCacheIfFiltered($tag->tagType);
    }

    public function forceDeleted(Tag $tag): void
    {
        $this->forgetFilteredTagTypesCacheIfFiltered($tag->tagType);
    }
}
