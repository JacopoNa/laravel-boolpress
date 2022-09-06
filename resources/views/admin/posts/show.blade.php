@extends('layouts.dashboard')

@section('content')
    <h1>{{ $post->title }}</h1>

    <p>{{ $post->content }}</p>

    <div>
        <div>Creato il: {{ $post->created_at->format('l d M Y') }}</div>
        <div>Aggiornato il: {{ $post->updated_at->format('l d M Y') }}</div>
        <div>Slug: {{ $post->slug }}</div>
    </div>

    <div>
        <a class="btn btn-primary" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Modifica il post</a>
    </div>

    <form action="{{ route('admin.posts.destroy', ['post' => $post->id] ) }}" method="post">
        @csrf
        @method('DELETE')
        <input class="btn btn-danger" type="submit" value="Cancella post">
    </form>

@endsection