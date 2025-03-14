@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>

        <h3>Category:</h3>
        <p>{{ $post->category->name }}</p>

        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
    </div>
@endsection
