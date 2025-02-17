<?php

namespace App\Http\Controllers\api\v1\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $collection = Post::query();

        //?sortby=created_at&sortdir=desc&_author=Leon?_limit=30?_offset=0
        $allowedFilterFields = (new Post())->getFillable();
        $allowedSortFields = ['id', ...$allowedFilterFields];
        $allowedSortDirection = ['asc','desc'];

        $sortBy = request()->query('sortby', 'id');
        $sortDir = request()->query('sortdir', 'asc');

        if (!in_array($sortBy, $allowedSortFields)) {
            $sortBy = $allowedSortFields[0];
        }
        if (!in_array($sortDir, $allowedSortDirection)) {
            $sortDir = $allowedSortDirection[0];
        }
        $collection->orderBy($sortBy, $sortDir);

        foreach ( $allowedFilterFields as $key) {
            if ($paramFilter = request()->query('_' . $key)) {
                $paramFilter = preg_replace("#([%_?+])#", "\\$1", $paramFilter);
                $collection->where($key, 'LIKE', '%'.$paramFilter.'%');
            }
        }

        $limit = intval(request()->query('limit', '20'));
        // $limit = min($limit, 20);
        $collection->limit($limit);

        $offset = intval(request()->query('offset', '0'));
        $offset = max($offset, 0);
        $collection->offset($offset);

        return $collection->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Post::create($request->only(['title', 'description']));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Post::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->only(['title', 'description']));
        return $post;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::findOrFail($id)->delete();
    }
}
