<?php

namespace Domains\Shared\Models;

use Database\Factories\UserFactory;
use Domains\Catalog\Models\Skill;
use Domains\File\Models\File;
use Domains\Module\Models\Module;
use Domains\Shared\Enums\RolesEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'activated_at',
        'role_id'
    ];

    protected $casts = [
        'role_id' => RolesEnum::class
    ];

    protected static function newFactory(): UserFactory
    {
        return new UserFactory();
    }

    public function status(): Attribute {
        return Attribute::make(
            get: function () {
                return match (true) {
                    is_null($this->activated_at) => 'Не подтвержден',
                    default => 'Подтвержден',
                };
            }
        );
    }

    public function bio(): HasOne
    {
        return $this->hasOne(UserBio::class, 'user_id', 'id');
    }

    public function skills(): BelongsToMany {
        return $this->belongsToMany(Skill::class);
    }

    public function files(): HasMany {
        return $this->hasMany(File::class);
    }

    public function modules(): HasMany {
        return $this->hasMany(Module::class);
    }
}
