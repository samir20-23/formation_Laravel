@extends('layouts.app')

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">{{ __('message.createPost') }}</a>
            <table class="table">
                <h1>{{ __('message.welcome') }}</h1>
                <h2>{{ __('messages.posts') }}</h2>
                <button>{{ __('messages.load_more') }}</button>

                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('message.Title') }}</th>
                        <th>{{ __('message.Catigorys') }}</th>
                        <th>{{ __('message.Tags') }}</th>
                        <th>{{ __('message.Actions') }}</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>
                                @foreach ($post->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">{{ __('message.View') }}</a>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">{{ __('message.Edit') }}</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">{{ __('message.Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
