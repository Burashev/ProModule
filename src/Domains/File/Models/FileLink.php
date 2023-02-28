<?php

namespace Domains\File\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'is_downloaded',
        'user_id',
    ];

    public function file(): BelongsTo {
        return $this->belongsTo(File::class);
    }
}
