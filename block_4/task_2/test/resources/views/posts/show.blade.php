@extends('layouts/layout')

@section('content')

        <h1>Post</h1>
            <p>{{$post->title}}</p>
            <p>{{$post->description}}</p>
            <a href={{route('posts.edit', $post->id)}}>Edit</a>

@endsection



