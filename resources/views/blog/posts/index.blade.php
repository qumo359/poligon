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

        .card-img-top {
            object-fit: cover; /* Чтобы изображения заполняли пространство и сохраняли пропорции */
            height: 200px; /* Задайте желаемую высоту для изображений */
            width: 100%;
        }
    </style>


{{--    @foreach(\App\Models\BlogCategory::all() as $category) --}}{{-- Получаем все категории --}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="{{ route('blog.categories.show', $category->slug) }}">{{ $category->title }}</a> --}}{{-- Ссылка на страницу категории --}}
{{--    </li>--}}
{{--    @endforeach--}}

    <div class="container">
        <div class="row">
            <div class="col-4">
                <nav class=" ">
                    <div class="container">
                        <h2   href="#">Категории</h2>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavCategories" aria-controls="navbarNavCategories" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>


                                @foreach($categories as $category)

                                        <br> <a   href="{{ route('blog.categories.show', $category->slug) }}">
                                            {{ $category->title }}
                                            <span class="badge bg-primary rounded-pill">{{ $category->posts_count }}</span> {{-- Значок с количеством постов --}}
                                        </a>

                                @endforeach


                    </div>
                </nav>

            </div>

            <div class="col-8">
                <a>Количество постов: {{count($items)}}</a>
                {{--        <div class="row row-eq-height">--}}
                @foreach($items as $item)
                    <div class="card mb-3">
                        @if($item->post_image) {{-- Проверяем, есть ли путь к изображению --}}
                        <img src="{{ asset('/storage/test/' . $item->post_image) }}" class="card-img-top" alt="{{ $item->title }}"> {{-- Выводим изображение --}}
                        @endif
                        <div class="card-body"> {{ $item->id }}
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->excerpt }}</p>
                            <p class="card-text"><small class="text-body-secondary">Создано: {{ $item->created_at }}</small>
                            </p>
                            <a href="{{ route('blog.posts.show', $item->id) }}" class="btn btn-primary">Читать далее</a>
                        </div>
                    </div>
                @endforeach
                {{ $items->links('vendor.pagination.bootstrap-5') }}
.
            </div>
        </div>

        </div>
{{--    </div>--}}
@endsection
