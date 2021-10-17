@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-info">
            <div class="card-header text-white bg-primary">
                <div class="row">
                    <h2 class="card-title col-sm-10">Добавление пользователя</h2>
                    <a class="col-sm-2" href="{{ route('users.index') }}">
                        <button class="btn btn-success float-right">Назад</button>
                    </a>
                </div>
            </div>
            <div class="card-body">

                <form autocomplete="off" method="post" action="{{ route('users.store' )}}">
                    @csrf
                    <x-form.input-text type="text" name="name" :value="old('name')" label="Имя" placeholder="Добавьте имя"/>

                    <x-form.input-text type="text" name="address" :value=" old('address')" label="Адрес" placeholder="Добавьте адрес"/>

                    <x-form.select id="city" name="city_id" :options="$cities" label="Город" :attribut="$user"/>

                    <x-form.input-text type="text" name="phone" :value="old('phone')" label="Номер телефона" placeholder="Добавьте номер телефона"/>

                    <x-form.input-text type="text" name="library_card" :value=" old('library_card')" label="Номер читательского билета" placeholder="Добавьте номер читательского билета"/>

                    <x-form.input-text type="email" name="email" :value="old('email')" label="Електронная почта" placeholder="Добавьте електронную почту"/>

                    <x-form.input-text type="password" name="password" label="Пароль" placeholder="Добавьте пароль"/>

                    <x-form.input-text type="password"
                                       name="password_confirmation"
                                       label="Проверка пароля"
                                       placeholder="Повторите пароль"
                                       id="exampleInputPassword1"
                    />

                    <button type="submit" class="btn btn-primary">Добавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    window.onload = function () {
        $('#city').select2({
            placeholder: 'Выберите город'
        });
    }
</script>
