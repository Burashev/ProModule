<?php

namespace Domains\File\Models;

use Domains\File\Support\FileManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static Builder|File query()
 */
class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'size',
        'extension',
        'path'
    ];

    public function fileLinks(): HasMany {
        return $this->hasMany(FileLink::class);
    }

    public function link(): Attribute {
        return Attribute::make(
            get: fn() => (new FileManager())->createFileLink($this)
        );
    }
}
