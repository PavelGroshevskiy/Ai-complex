<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /**
 * @use HasFactory<\Database\Factories\UserFactory>
*/
    use HasFactory, Notifiable , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nickname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function followings()
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'follower_id', 'followed_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'followed_id', 'follower_id');
    }

    public function posts():HasMany
    {
        return $this->hasMany(Post::class)->chaperone();
    }

    public function mentions():HasMany
    {
        return $this->hasMany(Mention::class, 'mentions', 'user_id', 'post_id');
    }


    public function mentionedPosts():BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'mentions', 'user_id', 'post_id');
    }

    

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
