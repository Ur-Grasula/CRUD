@extends('layouts.main_layout')
@section('titulo', 'Cadastrar')
@section('pagina', 'CADASTRAR')
@section('conteudo')
    <div class="container">
        <hr>
        <div class="row">

            {{-- TESTE DE CONFIMAÇÂO DE CADASTRO --}}
            {{-- O CODIGO VERIFICA SE O USUARIO FOI CADASTRADO COM SUCESSO OU NÂO E INFORMA O USUARIO --}}
            @if (session('status') == '1')
                <div class="alert alert-primary">
                    <h4>Usuario cadastrado com sucesso.</h4>
                </div>
            @elseif (session('status') == '0')
                <div class="alert alert-danger">
                    <h4>Erro ao tentar cadastrar usuario.</h4>
                    <h4>{{ session('mensagem') }}</h4>
                </div>
            @endif
            {{-- FIM DE TESTE DE CONFIRMAÇÂO DE CADASTRO --}}

            @if ($errors->any())
                <div class="alert alert-danger">
                    <h4>Erro de campo detectado:</h4>
                    <hr>
                    @foreach ($errors->all() as $mensagem_erro)
                        <p>{{ $mensagem_erro }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ Route('cadastrar_submissao') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="text_nome" class="form-label">Nome: </label>
                    <input type="text" name="text_nome" id="text_nome" class="form-control"
                        value="{{ old('text_nome') }}" placeholder="Nome">
                </div>

                <div class="mb-3">
                    <label for="text_email" class="form-label">Email: </label>
                    <input type="email" name="text_email" id="text_email" class="form-control"
                        value="{{ old('text_email') }}" placeholder="exemplo@exemple.com">
                </div>

                <div class="mb-3">
                    <label for="text_senha" class="form-label">Senha: </label>
                    <input type="password" name="text_senha" id="text_senha" class="form-control"
                        value="{{ old('text_senha') }}" placeholder="Senha">
                </div>

                <div class="mb-3">
                    <label for="text_senha_confirmacao" class="form-label">Confirmação de senha: </label>
                    <input type="password" name="text_senha_confirmacao" id="text_senha_confirmacao" class="form-control"
                        value="{{ old('text_senha_confirmacao') }}" placeholder="Confirmação de senha">
                </div>

                <input type="submit" value="Salvar" class="btn btn-primary">
                <input type="reset" value="Limpar" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
