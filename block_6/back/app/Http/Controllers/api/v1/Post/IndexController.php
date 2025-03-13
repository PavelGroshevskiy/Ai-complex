<?php

namespace App\Http\Controllers\api\v1\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        
        $user = Auth::guard('sanctum')->user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // $collection = Post::query();

        // $allowedFilterFields = (new Post())->getFillable();
        // $allowedSortFields = ['id', ...$allowedFilterFields];
        // $allowedSortDirection = ['asc','desc'];

        // $sortBy = request()->query('sortby', 'created_at');
        // $sortDir = request()->query('sortdir', 'desc');

        // if (!in_array($sortBy, $allowedSortFields)) {
        //     $sortBy = $allowedSortFields[0];
        // }
        // if (!in_array($sortDir, $allowedSortDirection)) {
        //     $sortDir = $allowedSortDirection[0];
        // }
        // $collection->orderBy($sortBy, $sortDir);

        // foreach ( $allowedFilterFields as $key) {
        //     if ($paramFilter = request()->query('_' . $key)) {
        //         $paramFilter = preg_replace("#([%_?+])#", "\\$1", $paramFilter);
        //         $collection->where($key, 'LIKE', '%'.$paramFilter.'%');
        //     }
        // }

        // $limit = intval(request()->query('limit', '20'));
        // // $limit = min($limit, 20);
        // $collection->limit($limit);

        // $offset = intval(request()->query('offset', '0'));
        // $offset = max($offset, 0);
        // $collection->offset($offset);

        // $mentionedPosts = DB::table('mentions')
        //     ->join('posts', 'mentions.post_id', '=', 'posts.id')
        //     ->where('mentions.user_id', $user->id)
        //     ->select('posts.*');
        // // dd($mentionedPosts->get());

        // $collection
        //     ->join('users', 'users.id', '=', 'posts.user_id')
        //     ->union($mentionedPosts)
        //     ->select('posts.*');

            
        // return $collection
        //     ->whereBelongsTo($user)
        //     ->get(['title','id']);


        // $followingIds = DB::table('users')->pluck('name');
        // dd($user->followings());
        // $posts = $user->posts()->get()->toArray();
        // $associate = Post::first()->user()->associate($user);

        // $mentions = $user->mentions()->get()->toArray();

        // dd($associate);

        $followingIds = $user->followings->pluck('id');


        $followingPosts = Post::whereIn('user_id', $followingIds)
            ->select('posts.*')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->addSelect('users.name as author', 'nickname');

        $mentionedPosts = $user->mentionedPosts()
            ->select('posts.*')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->addSelect('users.name as author', 'nickname');
            
        $ownPosts = $user->posts()
            ->select('posts.*')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->addSelect('users.name as author', 'nickname');

        $posts = $followingPosts
            ->union($mentionedPosts)
            ->union($ownPosts)
            ->latest() 
            ->paginate(10);


         // $limit = intval(request()->query('limit', '20'));
        // // $limit = min($limit, 20);
        // $collection->limit($limit);

        // $offset = intval(request()->query('offset', '0'));
        // $offset = max($offset, 0);
        // $collection->offset($offset);

        return $posts;
    }
}
