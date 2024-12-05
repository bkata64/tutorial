@extends('layouts.app')

@section('title', '| Teszt oldal')

@section('content')
    <div class="jumbotron">
        <h1>{{ $randomName }}</h1>
        <p class="lead">Ez az első demo route-unk!</p>
        <a class="btn btn-lg btn-primary" href="https://learn.pvga.hu" role="button">PVGA Learn »</a>
    </div>
@endsection

