<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
    protected $fillable = ['post_id', 'user_id'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'mentions', 'user_id', 'post_id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
