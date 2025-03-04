<?php

namespace App\Http\Controllers\api\v1\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class DeleteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Post $post)
    {
        Gate::authorize('update', $post);
        $post->delete();
        return [
            'message' => 'Post deleted success',
        ];
    }
}
