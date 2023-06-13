@extends('layouts.main_layout')
@section('titulo', 'Listar')
@section('conteudo')
    <hr>
    <div class="table-responsive">
        <div class="table-responsive">
            <table class="table">
                <caption>Numero de registros: {{ $data['registro'] }}</caption>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Senha</th>
                        <th scope="col">Criação</th>
                        <th scope="col">Atualizado</th>
                        <th scope="col">Atualizar</th>
                        <th scope="col">Excluir</th>
                    </tr>
                </thead>
                <tbody>

                    @if ($data['registro'] > 0)
                        @foreach ($data['usuario'] as $usuario)
                            <tr>
                                <th scope="row">{{ $usuario['id'] }}</th>
                                <td>{{ $usuario['nome'] }}</td>
                                <td>{{ $usuario['email'] }}</td>
                                <td>{{ $usuario['senha'] }}</td>
                                <td>{{ $usuario['created_at'] }}</td>
                                <td>{{ $usuario['updated_at'] }}</td>

                                <td>
                                    <form action="{{ Route('usuario_alterar', $usuario['id']) }}" method="get">
                                        @csrf
                                        <input type="submit" class="btn btn-primary" value="Altualizar">
                                    </form>
                                </td>

                                <td>
                                    <form action="{{ Route('usuario_deletar', $usuario['id']) }}" method="post">
                                        @csrf
                                        <input type="submit" class="btn btn-primary" value="Excluir">
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
@endsection
