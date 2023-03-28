@extends('layouts.main_layout')
@section('titulo', 'Listar')
@section('pagina', 'LISTAR')
@section('conteudo')
    <div class="container">
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
                            <th scope="col">Alterar dados</th>
                            <th scope="col">Excluir dados</th>
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
                                <td>
                                    <form action="{{ Route('alterar',[$usuario->id]) }}" method="get">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $usuario->id }}">
                                        <input class="btn btn-primary" type="submit" value="Alterar">
                                    </form>
                                </td>
                                <td>
                                    <form action="{{Route('deletar',[$usuario->id])}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $usuario->id }}">
                                        <input class="btn btn-primary" type="submit" value="Excluir">
                                    </form>
                                </td>
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
