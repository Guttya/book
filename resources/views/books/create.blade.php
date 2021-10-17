@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-info">
            <div class="card-header text-white bg-primary">
                <div class="row">
                    <h2 class="card-title col-sm-10">Создание книги</h2>
                    <a class="col-sm-2" href="{{ route('books.index') }}">
                        <button class="btn btn-success float-right">Назад</button>
                    </a>
                </div>
            </div>
            <div class="card-body">

                <form autocomplete="off" method="post" action="{{ route('books.store')}}" enctype="multipart/form-data">
                    @csrf

                    <x-form.input-text name="name" label="Название книги" :value="old('name')" type="text" placeholder="Добавьте название книги"/>

                    <x-form.texterea
                        id="exampleFormControlTextarea1"
                        name="description"
                        label="Краткое описание"
                        :value="old('description')"
                        placeholder="Добавьте краткое описание"
                    />

                        @php
                            $optionsAuthors = $authors->map(function ($author, $key) {
                               return ['id' => $author->id, 'name' => $author->fullName];
                           })->toArray();
                        @endphp

                    <x-form.select2
                        label="Автор"
                        id="authors"
                        name="authors[]"
                        :options="$optionsAuthors"
                        :selected="old('authors')"
                        placeholder="Выберите автора"
                    />

                    <x-form.select2
                        label="Тип обложки"
                        id="coverTypes"
                        name="cover_types[]"
                        :options="$coverTypes->toArray()"
                        :selected="old('cover_types')"
                        placeholder="Выберите тип обложки"
                    />

                    <x-form.select2
                        label="Жанр"
                        id="genres"
                        name="genres[]"
                        :options="$genres->toArray()"
                        :selected="old('genres')"
                        placeholder="Выберите жанр"
                    />

                    <x-form.input-file label="Книга" label2="Добавьте книгу" id="customFile" name="file" type="file"/>

                    <x-form.input-file label="Обложка" label2="Добавьте обложку" id="customFile" name="preview_img" type="file"/>

                    <button type="submit" class="btn btn-primary">Добавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    window.onload = function () {
        $(".js-select2").select2();

        bsCustomFileInput.init()
    }
</script>

