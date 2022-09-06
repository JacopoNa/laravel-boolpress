@extends('layouts.dashboard')

@section('content')
    <h1>{{ $post->title }}</h1>

    <p>{{ $post->content }}</p>

    <div>
        <div>Creato il: {{ $post->created_at }}</div>
        <div>Aggiornato il: {{ $post->updated_at }}</div>
        <div>Slug: {{ $post->slug }}</div>
    </div>

    <a class="btn btn-primary" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Modifica il post</a>

@endsection