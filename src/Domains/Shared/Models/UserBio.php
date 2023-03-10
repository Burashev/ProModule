<?php

namespace Domains\Shared\Models;

use Database\Factories\UserBioFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBio extends Model
{
    use HasFactory;

    protected $table = 'user_bio';

    protected $fillable = [
        'sex',
        'city',
        'institution',
        'institution_type',
        'user_id',
        'name'
    ];

    protected static function newFactory(): UserBioFactory
    {
        return new UserBioFactory();
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
