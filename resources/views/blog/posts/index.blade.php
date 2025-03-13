@extends('layouts.app')

@section('content')
    @include('blog.admin.admin_sidebar')
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @foreach($items as $item)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    @if($item->post_image)
                                        {{-- Проверяем, есть ли путь к изображению --}}
                                        <img src="{{ asset('/storage/test/' . $item->post_image) }}"
                                             class="card-img rounded-0"
                                             alt="{{ $item->title }}"> {{-- Выводим изображение --}}
                                    @else

                                        <img class="card-img rounded-0" src="/storage/test/imagenotfound.png" alt=" ">
                                    @endif
                                    <a href="#" class="blog_item_date">

                                        <h3>  {{ \Carbon\Carbon::create($item->created_at)->format('d') }}</h3>
                                        <p>  {{ \Carbon\Carbon::create($item->created_at)->format('M') }}</p>
                                    </a>
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block" href="{{ route('blog.posts.show', $item->id) }}">
                                        <h2>{{ $item->title }}</h2>
                                    </a>
                                    <p>{{ $item->excerpt }}</p>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="fa fa-user"></i> Admin</a></li>
                                        <li><a href="#"><i class="fa fa-comments"></i> {{ $item->comments()->count() }}
                                                Comments</a></li>
                                    </ul>
                                </div>
                            </article>
                        @endforeach

                        <nav class="blog-pagination justify-content-center d-flex">

                            {{ $items->links('vendor.pagination.bootstrap-5') }}

                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('partials._sidebar') {{-- Вставляем сайдбар --}}
                </div>
            </div>
        </div>
    </section>

@endsection


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
