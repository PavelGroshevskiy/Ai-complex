<?php

namespace App\Http\Controllers\api\v1\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class DeleteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke( $id)
    {
        $result = Post::findOrFail($id);
        return Post::destroy($id);
    }
}
