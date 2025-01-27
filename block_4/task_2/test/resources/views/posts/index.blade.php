@extends('layouts/layout')

@section('content')


<h2>{{ 'Posts' }}</h2>
 <span>
            <button id="refresh_posts">
                Refresh Posts
            </button>
        </span>
<ul>
    @forelse($posts as $post)
    <li>
        <a href="{{ route('posts.show', $post->id) }}">
            {{ $post->title }}
        </a>
        <p> - {{$post->description}}</p>
        <span>
            <button class="delete_post">
                Delete
            </button>
        </span>
    </li>
    <hr>
    @empty
    <li>No Posts Found</li>
    @endforelse
</ul>
@endsection






