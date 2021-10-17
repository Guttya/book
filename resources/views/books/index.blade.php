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

{{--                    <form action="{{ route('filter') }}" method="GET" style="margin-top: 20px;">--}}
{{--                        <select name="price_id" id="input">--}}
{{--                            <option value="0">Select Price</option>--}}
{{--                            @foreach (\App\Models\Author::select('id', 'authors')->get() as $authors)--}}
{{--                                <option value="{{ $authors->id }}" {{ $authors->id == $selected_id['authors'] ? 'selected' : '' }}>--}}
{{--                                    {{ $authors['authors'] }}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <select name="color_id" id="input">--}}
{{--                            <option value="0">Select Color</option>--}}
{{--                            @foreach (\App\Models\Genre::select('id','name')->get() as $genre)--}}
{{--                                <option value="{{ $genre->id }}" {{ $genre->id == $selected_id['genre'] ? 'selected' : '' }}>--}}
{{--                                    {{ $genre['genre'] }}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <input type="submit" class="btn btn-danger btn-sm" value="Filter">--}}
{{--                    </form>--}}




                            @php
                                $optionsAuthors = $authors->map(function ($author, $key) {
                                return ['id' => $author->id, 'name' => $author->fullName];
                                })->toArray();
                            @endphp

                            <div class="btn-group dropleft">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Сортировка
                                </button>
                                <div class="dropdown-menu">
                                    <form autocomplete="off" action="{{ route('books.index')}}" method="GET">
                                        @csrf

                                        <x-form.select2 label="Автор" id="authors" name="authors[]" :options="$optionsAuthors" :selected="old('authors')" placeholder="Выберите автора"/>
                                        <x-form.select2 label="Жанр" id="genres" name="genres[]" :options="$genres->toArray()" :selected="old('genres')" placeholder="Выберите жанр"/>

                                        <x-form.input-text name="name" label="Название книги" :value="old('name')" type="text" placeholder="Добавьте название книги"/>
                                        <x-form.input-text name="description" label="Description" :value="old('description')" type="text" placeholder="Добавьте название книги"/>

                                        <button type="submit" class="btn btn-primary">Искать</button>

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

