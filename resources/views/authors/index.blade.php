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
                    <h2 class="card-title col-sm-10">Список авторов</h2>
                    <a class="col-sm-2" href="{{ route('authors.create') }}">
                        <button class="btn btn-success float-right">Добавить автора</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Дата добавления</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($authors as $author)
                        <tr>
                            <th scope="row">{{ $author->id }}</th>
                            <td>{{ $author->fullName }}</td>
                            <td>{{ date('d-m-Y', strtotime($author->created_at)) }}</td>
                            <td>
                                <form class="form-inline" action="{{ route('authors.destroy', $author->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-sm btn-light" href="{{ route('authors.show', $author->id) }} ">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-info" href="{{ route('authors.edit', $author->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="confirm('Вы уверены что хотите удалить автора?')">
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
                {{ $authors->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
