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
        <div class="row row-eq-height"> {{-- Добавляем класс row-eq-height к строке --}}
            @foreach($items as $item)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->excerpt }}</p>
                            <p class="card-text"><small class="text-body-secondary">Создано: {{ $item->created_at }}</small></p>
                            <a href="{{ route('blog.posts.show', $item->id) }}" class="btn btn-primary">Читать далее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
{{--<table>--}}
{{--    @foreach($items as $item)--}}
{{--        <tr>--}}
{{--            <td>{{ $item->id }}</td>--}}
{{--            <td>{{ $item ->title }}</td>--}}
{{--            <td>{{ $item ->created_at }}</td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--</table>--}}
@endsection
