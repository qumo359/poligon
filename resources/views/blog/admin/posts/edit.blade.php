@extends('layouts.app')

@section('content')


    @php
        /** @var \App\Models\BlogPost $item */
    @endphp


{{--    {{$item->id}}--}}
{{--    <form method="POST" action="{{ route('blog.update', $item->id) }}" enctype="multipart/form-data">--}}
{{--        @csrf--}}
{{--        <input type="text" name="test">--}}
{{--        <input type="submit">--}}
{{--    </form>--}}

    <div class="container" id="admin-panel-content">

        @include('blog.admin.posts.includes.result_messages')

        @if($item->exists)
             <form method="POST" action="{{ route('admin.blog.update', $item->id) }}" enctype="multipart/form-data">

                @method('PATCH')
                @else
                    <form method="POST" action="{{ route('admin.posts.store') }}">
                        @endif

                        @csrf
                        <div class="row justify-content-center">
                            @include('blog.admin.admin_sidebar')
                            <div class="col-md-6">
                                @include('blog.admin.posts.includes.post_edit_main_col')
                            </div>
                            <div class="col-md-3">
                                @include('blog.admin.posts.includes.post_edit_add_col')
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <h4>Комментарии</h4>
                            <div class="comment-list"
                                 @if(@$comments)
                                @foreach($comments as $comment)
                                    @include('partials._comment', ['comment' => $comment]) {{-- Используем частичный шаблон для рекурсивного отображения --}}
                                @endforeach
                                 @endif
                            </div>
                        </div>
                    </form>>

                    @if($item->exists)
                        <br>
                        <form method="POST" action="{{ route('admin.posts.destroy', $item->id) }}">
                            @method('DELETE')
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card card-block">
                                        <div class="card-body ml-auto">
                                            <button type="submit" class="btn btn-link">Удалить</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </form>
        @endif
    </div>
@endsection
