<?php

namespace Domains\Module\Models;

use Database\Factories\ModuleFactory;
use Domains\Catalog\Models\Skill;
use Domains\Catalog\QueryBuilders\ModuleQueryBuilder;
use Domains\File\Models\File;
use Domains\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Support\Traits\HasSlug;

/**
 * @method static ModuleQueryBuilder|Module query()
 */
class Module extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'skill_id',
        'user_id',
        'author_id'
    ];

    protected static function newFactory(): ModuleFactory
    {
        return new ModuleFactory();
    }

    public function newEloquentBuilder($query): ModuleQueryBuilder
    {
        return new ModuleQueryBuilder($query);
    }

    public function mediaFiles(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'module_media_files');
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class);
    }
}
