<?php

namespace Domains\File\Models;

use Illuminate\Database\Eloquent\Builder;
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
}
