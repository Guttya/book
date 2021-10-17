@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
            </div>
        @endif
        <div class="card border-info">
            <div class="card-header text-white bg-primary">
                <div class="row">
                    <h2 class="card-title col-sm-10">Список книг</h2>
                    <a class="col-sm-2" href="{{ route('books.create') }}">
                        <button class="btn btn-success float-right">Добавить книгу</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        @php
                            $optionsAuthors = $authors->map(function ($author, $key) {
                                return ['id' => $author->id, 'name' => $author->fullName];
                                })->toArray();
                        @endphp
                        <div class="container">
                            <div class="row">
                                <form autocomplete="off" action="{{ route('books.index')}}" method="GET">
                                    @csrf
                                    <div class="col align-self-center">
                                        <x-form.select2 label="Автор" id="authors" name="authors[]" :options="$optionsAuthors" :selected="old('authors')" placeholder="Выберите автора"/>
                                    </div>
                                    <div class="col align-self-center">
                                        <x-form.input-text name="name" label="Название книги" :value="old('name')" type="text" placeholder="Выберите название книги"/>
                                    </div>
                                    <div class="col align-self-center">
                                        <button type="submit" class="btn btn-primary">Искать</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Названия</th>
                            <th scope="col">Автор</th>
                            <th scope="col">Дата загрузки</th>
                            <th scope="col">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <th scope="row">{{ $book->id }}</th>
                            <td>{{ $book->name }}</td>
                            <td>
                                @foreach($book->authors as $author)
                                    {{ $author->fullName }} <br>
                                @endforeach
                            </td>
                            <td>{{ date('d-m-Y', strtotime($book->created_at)) }}</td>
                            <td>
                                <form class="form-inline" action="{{ route('books.destroy', $book->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-sm btn-outline-success mr-1" href="{{ route('books.show', $book->id) }} ">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-outline-info mr-1" href="{{ route('books.edit', $book->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="confirm('Вы уверены что хотите удалить книгу?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $books->withQueryString()->links('vendor.pagination.bootstrap-4') }}
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

