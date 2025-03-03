@extends('layouts.app')

@section('content')
    <style>
        .row-eq-height {
            display: flex;
            flex-wrap: wrap;
        }

        .row-eq-height > .col-md-4 {
            display: flex;
            flex-direction: column;
        }

        .card {
            flex: 1;
        }
    </style>

    <div class="container">
        <h1>Категория: {{ $category->title }}</h1> {{-- Заголовок категории --}}
        <p>{{ $category->description }}</p> {{-- Описание категории (если есть) --}}

        <div class="row row-eq-height">
            @forelse($posts as $post) {{-- Перебираем посты категории --}}
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->excerpt }}</p>
                        <p class="card-text"><small class="text-body-secondary">Создано: {{ $post->created_at }}</small></p>
                        <a href="{{ route('blog.posts.show', $post->id) }}" class="btn btn-primary">Читать далее</a>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12">
                    <p>В данной категории пока нет постов.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
