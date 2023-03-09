@extends('layouts.main_layout')
@section('titulo', 'Home')
@section('conteudo')
    <div class="container">
        <h1>Listagem</h1>
        <hr>
        <div class="container">
            @if ($registro > 0)
                <div class="alert alert-primary">
                    <p>Numero de registros: {{ $registro }}</p>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Senha</th>
                            <th scope="col">Criado</th>
                            <th scope="col">Atualizado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->nome }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->senha }}</td>
                                <td>{{ $usuario->created_at }}</td>
                                <td>{{ $usuario->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-danger">
                    <p>Nenhum registro encontrado.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
