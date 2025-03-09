<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PostTag extends Pivot
{
    public $timestamps = false;

    function post()
    {
        $this->belongsTo(Post::class);
    }

    function tag()
    {
        $this->belongsTo(Tag::class);
    }
}
