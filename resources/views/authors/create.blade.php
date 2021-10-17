@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-info">
            <div class="card-header text-white bg-primary">
                <div class="row">
                    <h2 class="card-title col-sm-10">Добавление автора</h2>
                    <a class="col-sm-2" href="{{ route('authors.index') }}">
                        <button class="btn btn-success float-right">Назад</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{ route('authors.store' )}}">
                    @csrf
                    <x-form.input-text type="text" name="name" :value="old('name')" label="Имя" placeholder="Добавьте имя"/>

                    <x-form.input-text type="text" name="surname" :value="old('surname')" label="Фамилия" placeholder="Добавьте фамилию"/>

                    <x-form.texterea
                        id="exampleFormControlTextarea1"
                        name="description"
                        label="Краткая информация"
                        :value="old('description')"
                        placeholder="Добавьте краткое описание"
                    />

                    <x-form.input-file id="customFile" name="avatar" label="Фото автора" label2="Добавьте фото автора" type="file"/>

                    @if ($errors->has('avatar'))
                        <br>
                    @endif

                    <button type="submit" class="btn btn-primary">Добавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    window.onload = function () {
        bsCustomFileInput.init()
    }
</script>

