@extends('layouts.app')

@section('content')

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

                            {{--                            <ul class="pagination">--}}
                            {{--                                <li class="page-item">--}}
                            {{--                                    <a href="#" class="page-link" aria-label="Previous">--}}
                            {{--                                        <i class="ti-angle-left"></i>--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                                <li class="page-item">--}}
                            {{--                                    <a href="#" class="page-link">1</a>--}}
                            {{--                                </li>--}}
                            {{--                                <li class="page-item active">--}}
                            {{--                                    <a href="#" class="page-link">2</a>--}}
                            {{--                                </li>--}}
                            {{--                                <li class="page-item">--}}
                            {{--                                    <a href="#" class="page-link" aria-label="Next">--}}
                            {{--                                        <i class="ti-angle-right"></i>--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            {{--                            </ul>--}}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search Keyword"
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btn" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                        type="submit">Search
                                </button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Category</h4>
                            <ul class="list cat-list">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('blog.categories.show', $category->slug) }}" class="d-flex">
                                            <p>  {{ Str::ucfirst(Str::lower($category->title)) }}</p>
                                            <p>({{ $category->posts_count ?? 0 }})</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Random Post</h3>
                            @foreach($latestPosts as $latestPost)
                                <div class="media post_item">
                                    @if($latestPost->post_image)
                                        <img src="{{$latestPost->post_image}}" alt="">
                                    @else
                                        <img class="img-preview-container" src="/storage/test/imagenotfound.png" alt="NOimage">
                                    @endif
                                    <div class="media-body">
                                        <a href="single-blog.html">
                                            <h3>{{$latestPost->title}}</h3>
                                        </a>
                                        <p>{{\Carbon\Carbon::create($latestPost->published_at)->format('d-M')}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </aside>
                        <aside class="single_sidebar_widget tag_cloud_widget">
                            <h4 class="widget_title">Tag Clouds</h4>
                            <ul class="list">
                                <li>
                                    <a href="#">project</a>
                                </li>
                                <li>
                                    <a href="#">love</a>
                                </li>
                                <li>
                                    <a href="#">technology</a>
                                </li>
                                <li>
                                    <a href="#">travel</a>
                                </li>
                                <li>
                                    <a href="#">restaurant</a>
                                </li>
                                <li>
                                    <a href="#">life style</a>
                                </li>
                                <li>
                                    <a href="#">design</a>
                                </li>
                                <li>
                                    <a href="#">illustration</a>
                                </li>
                            </ul>
                        </aside>





                    </div>
                </div>
            </div>
        </div>
    </section>
{{--    @foreach(\App\Models\BlogCategory::all() as $category) --}}{{-- Получаем все категории --}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="{{ route('blog.categories.show', $category->slug) }}">{{ $category->title }}</a> --}}{{-- Ссылка на страницу категории --}}
{{--    </li>--}}
{{--    @endforeach--}}

{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-4">--}}
{{--                <nav class=" ">--}}
{{--                    <div class="container">--}}
{{--                        <h2   href="#">Категории</h2>--}}
{{--                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavCategories" aria-controls="navbarNavCategories" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                            <span class="navbar-toggler-icon"></span>--}}
{{--                        </button>--}}


{{--                                @foreach($categories as $category)--}}

{{--                                        <br> <a   href="{{ route('blog.categories.show', $category->slug) }}">--}}
{{--                                            {{ $category->title }}--}}
{{--                                            <span class="badge bg-primary rounded-pill">{{ $category->posts_count }}</span> --}}{{-- Значок с количеством постов --}}
{{--                                        </a>--}}

{{--                                @endforeach--}}


{{--                    </div>--}}
{{--                </nav>--}}

{{--            </div>--}}

{{--            <div class="col-8">--}}
{{--                <a>Количество постов: {{count($items)}}</a>--}}
{{--                --}}{{--        <div class="row row-eq-height">--}}
{{--                @foreach($items as $item)--}}
{{--                    <div class="card mb-3">--}}
{{--                        @if($item->post_image) --}}{{-- Проверяем, есть ли путь к изображению --}}
{{--                        <img src="{{ asset('/storage/test/' . $item->post_image) }}" class="card-img-top" alt="{{ $item->title }}"> --}}{{-- Выводим изображение --}}
{{--                        @endif--}}
{{--                        <div class="card-body"> {{ $item->id }}--}}
{{--                            <h5 class="card-title">{{ $item->title }}</h5>--}}
{{--                            <p class="card-text">{{ $item->excerpt }}</p>--}}
{{--                            <p class="card-text"><small class="text-body-secondary">Создано: {{ $item->created_at }}</small>--}}
{{--                            </p>--}}
{{--                            <a href="{{ route('blog.posts.show', $item->id) }}" class="btn btn-primary">Читать далее</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--                {{ $items->links('vendor.pagination.bootstrap-5') }}--}}
{{--.--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        </div>--}}
{{--    </div>--}}
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
