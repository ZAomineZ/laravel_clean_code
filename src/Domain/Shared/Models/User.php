<?php

declare(strict_types=1);

namespace Domain\Shared\Models;

use Database\Factories\PostFactory;
use Database\Factories\UserFactory;
use Domain\Blogging\Models\Post;
use Domain\Shared\Models\Concerns\HasKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasKey;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use SoftDeletes;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'first_name',
        'last_name',
        'email',
        'password',
        'theme',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * @return HasMany<Post>
     */
    public function posts(): HasMany
    {
        return $this->hasMany(
            Post::class, 'user_id'
        );
    }

    protected static function newFactory(): UserFactory
    {
        return resolve(UserFactory::class);
    }
}
