<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Post $post)
    {
        return view('posts.show')->with('post', $post);
    }
}
