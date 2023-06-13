@extends('layouts.main_layout')
@section('titulo', 'Alterar')
@section('conteudo')
    <hr>
    <div class="row">
        {{-- FORMULARIO --}}
        <form action="{{ Route('usuario_alterar_validate',$data['id']) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Nome: </label>
                <input type="text" name="nome" id="nome" class="form-control"
                    value="{{ old('nome', $data['nome']) }}" placeholder="Nome">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email: </label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $data['email']) }}" placeholder="exemplo@exemple.com">
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha: </label>
                <input type="password" name="senha" id="senha" class="form-control"
                    value="{{ old('senha', $data['senha']) }}" placeholder="Senha">
            </div>

            <div class="mb-3">
                <label for="senha_confirmacao" class="form-label">Confirmação de senha: </label>
                <input type="password" name="senha_confirmacao" id="senha_confirmacao" class="form-control"
                    value="{{ old('senha_confirmacao', $data['senha']) }}" placeholder="Confirmação de senha">
            </div>

            <input type="submit" class="btn btn-primary" value="Salvar">
            <a href="{{ Route('usuario_listar') }}" class="btn btn-primary">Cancelar</a>
        </form>
    </div>
@endsection
