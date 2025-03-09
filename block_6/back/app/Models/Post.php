<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = ['title', 'description', 'user_id'];

    // protected $casts = ['created_at' => 'date:d-m-Y \/\ H:i:s'];
    protected $casts = ['created_at' => 'datetime'];

    protected function title() :Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return ucfirst($value);
            },
            set: fn ($value) => $value
        )->shouldCache();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    function mentions()
    {
        return $this->hasMany(Mention::class);
    }

    function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
}
