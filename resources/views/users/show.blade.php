@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-info">
            <div class="card-header text-white bg-primary">
                <div class="row">
                    <h2 class="card-title col-sm-10">Users show</h2>
                    <a class="col-sm-2" href="{{ route('users.index') }}">
                        <button class="btn btn-success float-right">Назад</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"># {{ $user->id }}</li>

                    <li class="list-group-item">
                        <span class="font-weight-bold">Имя:</span>
                        {{ $user->name }}
                    </li>

                    <li class="list-group-item">
                        <span class="font-weight-bold">Електронная почта:</span>
                        {{ $user->email }}
                    </li>

                    <li class="list-group-item">
                        <span class="font-weight-bold">Дата регистрации:</span>
                        {{ date('d-m-Y', strtotime($user->created_at)) }}
                    </li>

                    @isset($user->userInfo)
                        <li class="list-group-item">
                            <span class="font-weight-bold">Город:</span>
                            {{ $user->userInfo->city->name }}
                        </li>

                        <li class="list-group-item">
                            <span class="font-weight-bold">Мобильный телефон:</span>
                            {{ $user->userInfo->phone }}
                        </li>
                        <li class="list-group-item">
                            <span class="font-weight-bold"> Номер читательского билета: </span>
                            {{ $user->userInfo->library_card }}
                        </li>
                    @endisset
                </ul>
            </div>
        </div>
    </div>
@endsection

