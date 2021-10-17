@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1 class="font-weight-bold text-info">Добро пожаловать в админ панель онлайн библиотеки</h1>
                </div>
                <div class="card-group">
                    @foreach($parsers as $parser)
                        <div class="card border-success">
                            <div class="card-body">
                                <h5 class="card-title text-success">{{ $parser['day_name'] }}</h5>
                                <p class="card-text">{{ $parser['day_number'] }} {{ $parser['month'] }}</p>
                                <div title="{{ $parser['weatherIco']['title'] }}">
                                    <img src="{{ $parser['weatherIco']['ico'] }}" width="50" alt="">
                                </div>
                                <p class="card-tex">{{ $parser['temperature']['min'] }}</p>
                                <p class="card-tex">{{ $parser['temperature']['max'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-group">
                    @foreach($exchanges as $exchange)
                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $exchange['ccy'] }}</h5>
                            <p class="card-text">Купить: {{ $exchange['buy'] }}</p>
                            <p class="card-text">Продать: {{ $exchange['sale'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
