@extends('layouts/layout')

@section('content')


<h2>{{ 'Posts' }}</h2>

<ul>
    @forelse($posts as $post)
    <li>
        <div>
        <a href="{{ route('posts.show', $post->id) }}">
            {{ $post->title }}
        </a>
        <p> - {{$post->description}}</p>
        </div>
    </li>
    <hr>
    @empty
    <li>No Posts Found</li>
    @endforelse
</ul>
@endsection






