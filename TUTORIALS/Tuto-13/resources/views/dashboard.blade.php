@extends('layouts.app')

@section('content')
<h1>Welcome, {{ Auth::user()->name }}</h1>
<p>Your account was created on: {{ Auth::user()->created_at->format('M d, Y') }}</p>

<h2>Your Articles:</h2>
@if($articles->count() > 0)
<ul>
    @foreach($articles as $article)
    <li>
        <strong>{{$article->title}}</strong>
        <p>{{$article->content}}</p>
        <em>Created: {{$article->created_at->diffForHumans()}}</em>
    </li>
    @endforeach
</ul>
@else
<p>You haven't written any articles yet.</p>
@endif

@endsection