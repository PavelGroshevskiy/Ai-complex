
@extends('layouts/app')

@section('title')
Create Job
@endsection

@section('content')

<div class="col-12 ml-3">

    <h2 class="ml-3">Create Post</h2>
    <form id="create_post" method="POST" action={{route('posts.store')}} >
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" >

        <label for="description">Body</label>
        <input type="text" name="description" >

        <input type="submit" value="submit">
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
