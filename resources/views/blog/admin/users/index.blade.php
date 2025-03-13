@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            @include('blog.admin.admin_sidebar')
            <div class="col-9">
                <table class="table"> {{-- Используем Bootstrap классы для таблицы (если Bootstrap подключен) --}}
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Дата регистрации</th>
                        <th>Действия
                        </th> {{-- Можно добавить столбцы с действиями, например, редактирование, удаление --}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        {{-- Перебираем коллекцию пользователей, переданную из контроллера --}}
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">Редактировать</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE') {{-- Метод spoofing - DELETE для удаления ресурса --}}
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Вы уверены, что хотите удалить этого пользователя?')">
                                        Удалить
                                    </button> {{-- Кнопка "Удалить" - с подтверждением через JavaScript --}}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
