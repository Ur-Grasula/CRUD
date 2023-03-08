@extends('layouts.main_layout')
@section('titulo','Home')
@section('conteudo')
    <div class="container">
        <h1>HOME</h1>
        <hr>
        <a href="{{Route('cadastro')}}">Cadastrar</a>
    </div>
@endsection
