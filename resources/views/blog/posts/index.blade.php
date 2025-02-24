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
        <div class="row row-eq-height">
            @php
                /** @var \Hamcrest\Collection\ $items */
               // Группируем по имени категории через связь 'category.name'
               $groupedItems = $items->groupBy('category.name');
            @endphp

            @foreach($groupedItems as $categoryName => $categoryItems)
                <div class="col-md-4">
                    <h3>{{ $categoryName ?? 'Без категории' }}</h3> {{-- Выводим имя категории, или "Без категории", если имя отсутствует --}}
                    @foreach($categoryItems as $item)
                        <div class="card mb-3">
                            <div class="card-body"> {{ $item->id }}
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="card-text">{{ $item->excerpt }}</p>
                                <p class="card-text"><small class="text-body-secondary">Создано: {{ $item->created_at }}</small></p>
                                <a href="{{ route('blog.posts.show', $item->id) }}" class="btn btn-primary">Читать далее</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
