<?php

namespace App\Http\Controllers\api\v1\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Post $post)
    {
        return Post::findOrFail($post);

    }
}
