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
                            @else
                                <img class="img-fluid" src="/storage/test/imagenotfound.png" alt="asd">
                            @endif
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
                            <div class="quote-wrapper">
                                <div class="quotes">
                                    {{$item->excerpt}}
                                </div>
                            </div>
                            <p>
                                {{$item->content_html}}
                            </p>
                        </div>
                    </div>
                    <div class="navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">
                            {{--TODO:Сделать лайки--}}
                            <p class="like-info"><span class="align-middle"><i class="fa fa-heart"></i></span>
                                {{ $item->likes->count() }} {{ trans_choice('Like|Likes', $item->likes->count()) }}
                            </p>
                            <div class="col-sm-4 text-center my-2 my-sm-0">
                            </div>
                            <ul class="social-icons">
                                <li>
                                    @auth
                                        @if(Auth::user()->likes()->where('blog_post_id', $item->id)->exists())
                                            <form action="{{ route('blog.posts.unlike', $item) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-sm btn-danger">Убрать лайк</button>
                                            </form>
                                        @else
                                            <form action="{{ route('blog.posts.like', $item) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary">Лайкнуть</button>
                                            </form>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary">Войдите,
                                            чтобы лайкнуть</a>
                                    @endauth
                                </li>
                                <li><a href="https://facebook.com"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://dribble.com"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="https://behance.net"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                        <div class="navigation-area">
                            <div class="row">
                                @if($prev)
                                    <div
                                        class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                        <div class="thumb">
                                            <a href="{{route('blog.posts.show', $prev)}}">
                                                @if($prev->post_image)
                                                    <img class="img-fluid"
                                                         src="{{asset('/storage/test/' . $prev->post_image)}}" alt="">
                                                @else
                                                    <img class="img-fluid" src="/storage/test/imagenotfound.png" alt="">
                                                @endif

                                            </a>
                                        </div>
                                        <div class="detials">
                                            <p>Предыдущий пост</p>
                                            <a href="{{route('blog.posts.show', $prev)}}">
                                                <h4>{{$prev->title}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                        <div class="thumb">
                                            {{--                                            <a href="">--}}
                                            {{--                                                <img class="img-fluid" src="/storage/test/imagenotfound.png" alt="">--}}
                                            {{--                                            </a>--}}
                                        </div>
                                        <div class="detials">
                                            <p>Предыдущий пост</p>
                                            <a>
                                                <h4>Пусто</h4>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                @if($next)
                                    <div
                                        class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                        <div class="thumb">
                                            <a href="{{route('blog.posts.show', $next)}}">
                                                @if($next->post_image)
                                                    <img class="img-fluid"
                                                         src="{{asset('/storage/test/' . $next->post_image)}}" alt="">
                                                @else
                                                    <img class="img-fluid" src="/storage/test/imagenotfound.png" alt="">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="detials">
                                            <p>Следующий пост</p>
                                            <a href="{{route('blog.posts.show', $next)}}">
                                                <h4>{{$next->title}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <h4>Пусто</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="comments-area">
                        <h4>Комментарии</h4>
                        <div class="comment-list">
                            @foreach($comments as $comment)
                                @include('partials._comment', ['comment' => $comment]) {{-- Используем частичный шаблон для рекурсивного отображения --}}
                            @endforeach
                        </div>
                        {{--                        @foreach($comments as $comment)--}}
                        {{--                            <div class="comment-list">--}}
                        {{--                                <div class="single-comment justify-content-between d-flex">--}}
                        {{--                                    <div class="user justify-content-between d-flex">--}}
                        {{--                                        <div class="thumb">--}}
                        {{--                                            <img src="/storage/test/commentimage.png" alt="">--}}
                        {{--                                        </div>--}}

                        {{--                                        <div class="desc">--}}
                        {{--                                            <p class="comment">--}}
                        {{--                                                {{$comment->body}}--}}
                        {{--                                            </p>--}}
                        {{--                                            <div class="d-flex justify-content-between">--}}
                        {{--                                                <div class="d-flex align-items-center">--}}
                        {{--                                                    <h5>--}}
                        {{--                                                        <a href="#">{{$comment->user->name}}</a>--}}
                        {{--                                                    </h5>--}}
                        {{--                                                    <p class="date">{{ $comment->created_at->diffForHumans() }}</p>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="reply-btn">--}}
                        {{--                                                    <a href="#" class="btn-reply text-uppercase">reply</a>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}

                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        @endforeach--}}


                        <div class="comment-form">
                            <h4>Оставить комментарий</h4>
                            <form method="POST" action="{{ route('blog.posts.comments.store', $item)}}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30"
                                                  rows="9" placeholder="Write Comment">Написать комментарий</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="button button-contactForm btn_1 boxed-btn">Отправить
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('partials._sidebar') {{-- Вставляем сайдбар --}}
                </div>
            </div>
        </div>
    </section>
@endsection
