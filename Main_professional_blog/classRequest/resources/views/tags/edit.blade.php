@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Tag</h1>

        <form action="{{ route('tags.update', $tag->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tag Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $tag->name) }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Tag</button>
        </form>
    </div>
@endsection
