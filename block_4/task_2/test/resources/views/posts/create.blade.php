
@extends('layouts/layout')

@section('title')
Create Job
@endsection

@section('content')

<div class="col-12">

    <h2>Create Post</h2>
    <form id="create_post" method="POST" action="/posts" >
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title"  class="pt-6 dark:bg-black">

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
