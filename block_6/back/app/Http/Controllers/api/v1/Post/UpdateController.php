<?php

namespace App\Http\Controllers\api\v1\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;

class UpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(UpdateRequest $request, Post $post)
    {
        $post = Post::findOrFail($post);
        $post->update($request->only(['title', 'description']));
        return response()->json(
            [
            'message' => 'success',
            'post' => $post
            ]
        );
    }
}
