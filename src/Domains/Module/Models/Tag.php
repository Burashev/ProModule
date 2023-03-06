<?php

namespace Domains\Module\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected static function newFactory(): TagFactory
    {
        return new TagFactory();
    }

    public function modules(): BelongsToMany {
        return $this->belongsToMany(Module::class);
    }

    public function tagType(): BelongsTo {
        return $this->belongsTo(TagType::class);
    }
}
