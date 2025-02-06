<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Services\DefoltPost;

class DefaultController extends Controller
{
    protected $post;
    public function __construct(DefoltPost $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        return ($this->post->index());
    }
}
