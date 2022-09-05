@extends('layouts.dashboard')

@section('content')
    <h1>{{ $post->title }}</h1>

    <p>{{ $post->content }}</p>

    <div>
        <div>Creato il: {{ $post->created_at }}</div>
        <div>Aggiornato il: {{ $post->updated_at }}</div>
        <div>Slug: {{ $post->slug }}</div>
    </div>

@endsection