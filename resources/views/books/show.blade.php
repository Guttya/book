@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-info">
            <div class="card-header text-white bg-primary">
                <div class="row">
                    <h2 class="card-title col-sm-10">Просмотр книги</h2>
                    <a class="col-sm-2" href="{{ route('books.index') }}">
                        <button class="btn btn-success float-right">Назад</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <img src="{{ asset('storage/' . $book->preview_img) }}" style="width: 300px" alt="File is missing">
                    </li>
                    <li class="list-group-item">
                        <span class="font-weight-bold">#</span>
                        {{ $book->id }}
                    </li>
                    <li class="list-group-item">
                        <span class="font-weight-bold">Название:</span>
                        {{ $book->name }}
                    </li>

                    <li class="list-group-item">
                        <span class="font-weight-bold">Краткое описание:</span>
                        {{ $book->description }}
                    </li>

                    <li class="list-group-item">
                        <span class="font-weight-bold">Тип обложки:</span>
                        {{ $book->covers->implode('name', ', ') }}.
                    </li>

                    <li class="list-group-item">
                        <span class="font-weight-bold">Жанр:</span>
                        {{ $book->genres->implode('name', ', ') }}.
                    </li>

                    <li class="list-group-item">
                        <span class="font-weight-bold">Автор:</span>
                        {{ $book->authors->implode('fullName', ', ') }}.
                    </li>
                    <li class="list-group-item">
                        <object data="{{ asset('storage/' . $book->file) }}" type="application/pdf" width="100%" height="800px">
                            <p>It appears you don't have a PDF plugin for this browser.
                                No biggie... you can <a href="{{ asset('storage/' . $book->file) }}">click here to
                                    download the PDF file.</a></p>
                        </object>
                    </li>

                    <li class="list-group-item">
                        <span class="font-weight-bold">Дата создания:</span>
                        {{ date('d-m-Y', strtotime($book->created_at)) }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

