<?php

namespace App\Http\Controllers\api\v1\Post;

use App\Http\Controllers\api\v1\Post\Requests\StorePostRequest;
use App\Http\Controllers\Controller;

use App\Models\Mention;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collection = Post::query();

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


        $collection->with(['user', 'mentions.user', 'tags']);
        return $collection->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        DB::transaction(
            function () use ($request) {

                $data = $request->validated();
                $post = $request->user()->posts()->create($data);

                preg_match_all('/@(\w+)/', $request->description, $mentions);
                foreach ($mentions[1] as $nickname) {

                    $user = User::where('nickname', $nickname)->first();
                    if ($user) {
                        Mention::create(
                            [
                            'post_id' => $post->id,
                            'user_id' => $user->id,
                            ]
                        );
                    }
                }

                preg_match_all('/#(\w+)/', $request->description, $hashtags);
                foreach ($hashtags[1] as $hashtagName) {
                    $title = Tag::firstOrCreate(['title' => $hashtagName]);
                    $post->tags()->attach($title->id);
                }
            }
        );
        return response()->json(
            [
                'success' => 'true',
                'message'=>'Post creat succesfully'
                ]
        );
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
