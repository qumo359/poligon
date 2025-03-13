@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            @include('blog.admin.admin_sidebar')
            <div class="col-9">
                <h1>Редактирование пользователя: {{ $user->name }}</h1>

                <form action="{{ route('admin.users.update', $user) }}"
                      method="POST"> {{-- Форма отправляется на маршрут admin.users.update для текущего пользователя --}}
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Имя:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                               required> {{-- Поле для имени, текущее значение пользователя --}}
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                               required> {{-- Поле для email, текущее значение пользователя --}}
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить изменения
                    </button> {{-- Кнопка "Сохранить" --}}
                    <a href="{{ route('admin.users.index') }}"
                       class="btn btn-secondary">Отмена</a> {{-- Кнопка "Отмена" - возврат к списку пользователей --}}
                </form>
            </div>
        </div>
    </div>
@endsection
