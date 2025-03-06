@extends('layouts.app')

@section('content')
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            @if($item->post_image)
                                <img class="img-fluid" src="{{ asset('/storage/test/' . $item->post_image)}}" alt="asd">
                            @endif
                            <img class="img-fluid" src="/storage/test/imagenotfound.png" alt="asd">
                        </div>
                        <div class="blog_details">
                            <h1>
                                {{$item->title}}
                            </h1>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="{{route('blog.categories.show', $item->category->slug)}}"><i
                                            class="fa fa-user"></i>{{Str::ucfirst(Str::lower($item->category->title))}}
                                    </a></li>
                                <li><a href="#"><i class="fa fa-comments"></i>{{$item->comments->count()}} Комментариев</a>
                                </li>
                            </ul>
                            <p class="excerpt">
                                {{$item->excerpt}}
                            </p>
                            <p>
                                {{$item->content_html}}
                            </p>
                            <div class="quote-wrapper">
                                <div class="quotes">
                                    {{$item->excerpt}}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">
                            {{--TODO:Сделать лайки--}}
                            <p class="like-info"><span class="align-middle"><i class="fa fa-heart"></i></span> Lily and
                                4
                                people like this</p>
                            <div class="col-sm-4 text-center my-2 my-sm-0">
                                <!-- <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> 06 Comments</p> -->
                            </div>
                            <ul class="social-icons">
                                <li><a href="https://facebook.com"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://dribble.com"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="https://behance.net"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                        <div class="navigation-area">
                            <div class="row">
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    <div class="thumb">
                                        <a href="#">
                                            <img class="img-fluid" src="/public/img/post/preview.png" alt="">
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="#">
                                            <span class="lnr text-white ti-arrow-left"></span>
                                        </a>
                                    </div>
                                    <div class="detials">
                                        <p>Prev Post</p>
                                        <a href="#">
                                            <h4>Space The Final Frontier</h4>
                                        </a>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    <div class="detials">
                                        <p>Next Post</p>
                                        <a href="#">
                                            <h4>Telescopes 101</h4>
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="#">
                                            <span class="lnr text-white ti-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="thumb">
                                        <a href="#">
                                            <img class="img-fluid" src="/public/img/post/next.png" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-author">
                        <div class="media align-items-center">
                            <img src="/public/img/blog/author.png" alt="">
                            <div class="media-body">
                                <a href="#">
                                    <h4>Harvard milan</h4>
                                </a>
                                <p>Second divided from form fish beast made. Every of seas all gathered use saying
                                    you're, he
                                    our dominion twon Second divided from</p>
                            </div>
                        </div>
                    </div>
                    <div class="comments-area">
                        <h4></h4>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="/public/img/comment/comment_1.png" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment">
                                            Multiply sea night grass fourth day sea lesser rule open subdue female fill
                                            which them
                                            Blessed, give fill lesser bearing multiply sea night grass fourth day sea
                                            lesser
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                                    <a href="#">Emilly Blunt</a>
                                                </h5>
                                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="#" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="/public/img/comment/comment_2.png" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment">
                                            Multiply sea night grass fourth day sea lesser rule open subdue female fill
                                            which them
                                            Blessed, give fill lesser bearing multiply sea night grass fourth day sea
                                            lesser
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                                    <a href="#">Emilly Blunt</a>
                                                </h5>
                                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="#" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="/public/img/comment/comment_3.png" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment">
                                            Multiply sea night grass fourth day sea lesser rule open subdue female fill
                                            which them
                                            Blessed, give fill lesser bearing multiply sea night grass fourth day sea
                                            lesser
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                                    <a href="#">Emilly Blunt</a>
                                                </h5>
                                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="#" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-form">
                        <h4>Leave a Reply</h4>
                        <form method="POST" action="{{ route('blog.posts.comments.store', $item)}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30"
                                                  rows="9" placeholder="Write Comment"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="name" id="name" type="text"
                                               placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" type="email"
                                               placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="website" id="website" type="text"
                                               placeholder="Website">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="button button-contactForm btn_1 boxed-btn">Send Message
                                </button>
                            </div>
                        </form>
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
                                            <p>  {{ $category->title }}</p>
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
                    </div>
                </div>
            </div>
        </div>
    </section>




    {{--    <div class="container text-center">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col">--}}
    {{--                <h1>{{$item->title}}</h1>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="col">--}}
    {{--            {!! $item->content_raw !!}--}}
    {{--        </div>--}}

    {{--        <hr>--}}

    {{--        <h2>Комментарии</h2>--}}

    {{--        @if ($comments->IsNotEmpty())--}}
    {{--            <ul class="list-unstyled">--}}
    {{--                @foreach ($comments as $comment)--}}
    {{--                    <li class="media">--}}
    {{--                        <div class="media-body">--}}
    {{--                            <h5 class="mt-0 mb-1">--}}
    {{--                                @if ($comment->user)--}}
    {{--                                    {{ $comment->user->name }}--}}
    {{--                                @else--}}
    {{--                                    Аноним--}}
    {{--                                @endif--}}
    {{--                                <small class="text-muted"> - {{ $comment->created_at->diffForHumans() }}</small>--}}
    {{--                            </h5>--}}
    {{--                            {{ $comment->body }}--}}
    {{--                        </div>--}}
    {{--                    </li>--}}
    {{--                    <hr>--}}
    {{--                @endforeach--}}
    {{--            </ul>--}}
    {{--        @else--}}
    {{--            <p>Пока нет комментариев.</p>--}}
    {{--        @endif--}}

    {{--        <hr>--}}

    {{--        <h3>Добавить комментарий</h3>--}}

    {{--        <form method="POST" action="{{ route('blog.posts.comments.store', $item) }}">--}}
    {{--            @csrf--}}
    {{--            <div class="mb-3">--}}
    {{--                <label for="body" class="form-label">Ваш комментарий:</label>--}}
    {{--                <input type="hidden" name="body" id="comment-body-hidden">--}}
    {{--                <div id="comment-body"></div>--}}
    {{--                                <textarea class="form-control" id="body" name="body" rows="3" required></textarea>--}}
    {{--            </div>--}}
    {{--            <button type="submit" class="btn btn-primary">Отправить комментарий</button>--}}
    {{--        </form>--}}
    {{--    </div>--}}
@endsection
