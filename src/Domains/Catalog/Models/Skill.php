<?php

namespace Domains\Catalog\Models;

use Database\Factories\SkillFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'name'];

    protected static function newFactory(): SkillFactory
    {
        return new SkillFactory();
    }
}
