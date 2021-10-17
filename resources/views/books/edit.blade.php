@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-info">
            <div class="card-header text-white bg-primary">
                <div class="row">
                    <h2 class="card-title col-sm-10">Изменение книги</h2>
                    <a class="col-sm-2" href="{{ route('books.index') }}">
                        <button class="btn btn-success float-right">Назад</button>
                    </a>
                </div>
            </div>
            <div class="card-body">

                <form autocomplete="off" method="POST" enctype="multipart/form-data" action="{{ route('books.update', $book->id )}}">
                    @csrf
                    @method('PATCH')
                    <x-form.input-text name="name" label="Название книги" :value="$book->name" type="text" placeholder="Добавьте название книги"/>

                    <x-form.texterea
                        id="exampleFormControlTextarea1"
                        name="description"
                        label="Краткое описание"
                        :value="$book->description"
                        placeholder="Добавьте краткое описание"
                    />

                    @php
                        $optionsAuthors = $authors->map(function ($author, $key) {
                            return ['id' => $author->id, 'name' => $author->fullName];
                        })->toArray();

                        $selectedAuthors = $book->authors->map(function ($author, $key) {
                            return $author->id;
                        })->toArray();
                    @endphp

                    <x-form.select2
                        label="Автор"
                        id="authors"
                        name="authors[]"
                        :options="$optionsAuthors"
                        :selected="$selectedAuthors"
                        placeholder="Выберите автора"
                    />

                    @php
                        $selectedCovers = $book->covers->map(function ($cover, $key) {
                            return $cover->id;
                        })->toArray();
                    @endphp

                    <x-form.select2
                        label="Тип обложки"
                        id="coverTypes"
                        name="cover_types[]"
                        :options="$coverTypes->toArray()"
                        :selected="$selectedCovers"
                        placeholder="Выберите тип обложки"
                    />

                    @php
                        $selectedGenres = $book->genres->map(function ($genre, $key) {
                            return $genre->id;
                        })->toArray();

                    @endphp

                    <x-form.select2
                        label="Жанр"
                        id="genres"
                        name="genres[]"
                        :options="$genres->toArray()"
                        :selected="$selectedGenres"
                        placeholder="Выберите жанр"
                    />

                    <x-form.input-file label="Книга" label2="Добавьте книгу" id="customFile" name="file" type="file"/>

                    @if ($errors->has('file'))
                        <br>
                    @endif

                    <div class="form-group">
                        <figure class="figure">
                            <img src="{{ asset('storage/' . $book->preview_img) }}" class="figure-img img-fluid rounded mg-fluid" alt="File is missing">
                        </figure>
                    </div>

                    <x-form.input-file label="Обложка" label2="Добавьте обложку" id="customFile" name="preview_img" type="file"/>

                    @if ($errors->has('preview_img'))
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
        $(".js-select2").select2();

        bsCustomFileInput.init()
    }
</script>
