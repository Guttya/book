@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-info">
            <div class="card-header text-white bg-primary">
                <div class="row">
                    <h2 class="card-title col-sm-10">Просмотр автора</h2>
                    <a class="col-sm-2" href="{{ route('authors.index') }}">
                        <button class="btn btn-success float-right">Назад</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <img src="{{ asset('storage/' . $author->avatar) }}"  alt="File is missing">
                    </li>
                    <li class="list-group-item">{{ $author->fullName }}</li>
                    <li class="list-group-item">{{ $author->description }}</li>
                    <li class="list-group-item">
                        <span class="font-weight-bold">Дата создания:</span>
                        {{ date('d-m-Y', strtotime($author->created_at)) }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

