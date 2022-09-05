@extends('layouts.dashboard')

@section('content')
    <h1>Tutti i post</h1>

    <div class="row row-cols-3">
        @foreach ($posts as $post)
            <div class="col mt-3">
                <div class="card">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    {{-- <p class="card-text"></p> --}}
                    <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Dettagli post</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection