<?php

namespace Domains\Module\Models;

use Database\Factories\TagTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TagType extends Model
{
    use HasFactory;

    protected static function newFactory(): TagTypeFactory
    {
        return new TagTypeFactory();
    }

    public function tags(): HasMany {
        return $this->hasMany(Tag::class);
    }
}
