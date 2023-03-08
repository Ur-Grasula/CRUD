@extends('layouts.main_layout')
@section('titulo', 'Cadastrar')
@section('conteudo')
    <div class="container">
        <h1>Cadastrar</h1>
        <hr>
        <div class="row">
            <form action="{{ Route('cadastrar_submissao') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="text_nome" class="form-label">Nome: </label>
                    <input type="text" name="text_nome" id="text_nome" class="form-control" placeholder="Nome">
                </div>

                <div class="mb-3">
                    <label for="text_email" class="form-label">Email: </label>
                    <input type="email" name="text_email" id="text_email" class="form-control"
                        placeholder="exemplo@exemple.com">
                </div>

                <div class="mb-3">
                    <label for="text_senha" class="form-label">Senha: </label>
                    <input type="password" name="text_senha" id="text_senha" class="form-control" placeholder="Senha">
                </div>

                <input type="submit" value="Cadastrar" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
