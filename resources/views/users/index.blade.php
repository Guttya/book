@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-info">
            <div class="card-header text-white bg-primary">
                <div class="row">
                    <h2 class="card-title col-sm-10">Список пользователей</h2>
                    <a class="col-sm-2" href="{{ route('users.create') }}">
                        <button class="btn btn-success float-right">Добавить пользователя</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Електронная почта</th>
                        <th scope="col">Дата регистрации</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                            <td>
                                <form class="form-inline" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-sm btn-light" href="{{ route('users.show', $user->id) }} ">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-info" href="{{ route('users.edit', $user->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $users->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
