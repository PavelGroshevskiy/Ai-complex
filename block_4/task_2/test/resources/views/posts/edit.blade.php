
@extends('layouts/layout')

@section('title')
Create Job
@endsection

@section('content')

<div class="col-12">

    <h2>Create Post</h2>
    <form id="edit_post" method="POST" action={{route('posts.update', $post->id)}} >
        @csrf
        @method('patch')
        <label for="title">Title</label>
        <input type="text" name="title" value={{$post->title}} class="pt-6 dark:bg-black">

        <label for="description">Body</label>
        <input type="text" name="description" value={{$post->description}} >

        <input type="submit" value="update">
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

@endsection
