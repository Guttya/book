@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-info">
            <div class="card-header text-white bg-primary">
                <div class="row">
                    <h2 class="card-title col-sm-10">Изменение информации о пользователе</h2>
                    <a class="col-sm-2" href="{{ route('users.index') }}">
                        <button class="btn btn-success float-right">Назад</button>
                    </a>
                </div>
            </div>
            <div class="card-body">

                <form autocomplete="off" method="POST" action="{{ route('users.update', $user->id )}}">
                    @csrf
                    @method('PATCH')

                    <x-form.input-text type="text" name="name" :value="$user->name" label="Имя" placeholder="Добавьте имя"/>

                    <x-form.input-text type="text" name="address" :value=" $user->userInfo->address ?? null" label="Адрес" placeholder="Добавьте адрес"/>

                    <x-form.select id="city" name="city_id" :options="$cities" label="Город" :attribut="$user"/>

                    <x-form.input-text type="text" name="phone" :value=" $user->userInfo->phone ?? null" label="Номер телефона" placeholder="Добавьте номер телефона"/>

                    <x-form.input-text type="text" name="library_card" :value=" $user->userInfo->library_card ?? null" label="Номер читательского билета" placeholder="Добавьте номер читательского билета"/>

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
