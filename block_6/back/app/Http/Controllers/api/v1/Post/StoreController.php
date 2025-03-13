<?php

namespace App\Http\Controllers\api\v1\Post;

use App\Http\Controllers\api\v1\Post\Requests\StorePostRequest;
use App\Http\Controllers\Controller;
use App\Models\Mention;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected function createMentions(array $mentions, Post $post)
    {
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
    }

    protected function createTag(array $hashtags, Post $post)
    {
        foreach ($hashtags[1] as $hashtagName) {
            $title = Tag::firstOrCreate(['title'=>$hashtagName]);
            $post->tags()->attach($title->id);
        }
    }

    public function __invoke(StorePostRequest $request)
    {
        $data = $request->validated();
        $post = $request->user()->posts()->create($data);

        preg_match_all('/@(\w+)/', $request->description, $mentions);

        preg_match_all('/#(\w+)/', $request->description, $hashtags);


            DB::transaction(
                function () use ($post, $mentions, $hashtags) {
                    $this->createMentions($mentions, $post);
                    $this->createTag($hashtags, $post);
                }, 5
            );
            return response()->json(
                [
                'success' => 'true',
                'message'=>'Post creat succesfully'
                ]
            );
    }
    
}