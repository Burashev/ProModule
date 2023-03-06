<?php

namespace Domains\Module\Models;

use Database\Factories\TagTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagType extends Model
{
    use HasFactory;

    protected static function newFactory(): TagTypeFactory
    {
        return new TagTypeFactory();
    }
}
