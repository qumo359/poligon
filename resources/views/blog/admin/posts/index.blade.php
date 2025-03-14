@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    @include('blog.admin.admin_sidebar')
                    <div class="col-8">

                        @include('blog.admin.posts.includes.result_messages')

                        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                            <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Написать</a>

                            {{--                    <a class="btn btn-primary" href="{{ route('blog.admin.posts.create') }}">Пользователи</a>--}}
                            @if(session('deleted_id'))
                                <a class="btn btn-danger"
                                   href="{{ route('admin.posts.restore', session('deleted_id')) }}">Отменить
                                    удаление</a>
                            @endif
                        </nav>

                        {{--                        @include('blog.admin.posts.includes.users_show_col')</div>--}}


                        <div class="col-md-12 ">

                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Автор</th>
                                            <th>Категория</th>
                                            <th>Заголовок</th>
                                            <th>Дата публикации</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($paginator as $post)
                                            {{--                                @php--}}
                                            {{--                                    /**  @var \App\Models\BlogPost $post */--}}
                                            {{--                                @endphp--}}
                                            <tr @if(!$post->is_published) style="background-color: darkgrey" @endif>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->user->name }}</td>
                                                <td>{{ $post->category->title }}</td>
                                                <td>
                                                    <a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->title }}</a>
                                                </td>
                                                <td>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.M.H:i') : '' }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($paginator->total() > $paginator->count())
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{ $paginator->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
@endsection
