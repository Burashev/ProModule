<?php

namespace Domains\Shared\Models;

use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static User|Builder query()
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'role_id'
    ];

    protected static function newFactory(): UserFactory
    {
        return new UserFactory();
    }

    public function bio(): HasOne
    {
        return $this->hasOne(UserBio::class, 'user_id', 'id');
    }
}
