@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h1>{{$item->title}}</h1>
            </div>
        </div>
        <div class="col">
            {!! $item->content_raw !!}
        </div>

        <hr>

        <h2>Комментарии</h2>

        @if ($comments->IsNotEmpty())
            <ul class="list-unstyled">
                @foreach ($comments as $comment)
                    <li class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">
                                @if ($comment->user)
                                    {{ $comment->user->name }}
                                @else
                                    Аноним
                                @endif
                                <small class="text-muted"> - {{ $comment->created_at->diffForHumans() }}</small>
                            </h5>
                            {{ $comment->body }}
                        </div>
                    </li>
                    <hr>
                @endforeach
            </ul>
        @else
            <p>Пока нет комментариев.</p>
        @endif

        <hr>

        <h3>Добавить комментарий</h3>

        <form method="POST" action="{{ route('blog.posts.comments.store', $item) }}">
            @csrf
            <div class="mb-3">
                <label for="body" class="form-label">Ваш комментарий:</label>
                <input type="hidden" name="body" id="comment-body-hidden">
                <div id="comment-body"></div>
                                <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить комментарий</button>
        </form>
    </div>
@endsection
