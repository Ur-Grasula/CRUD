@extends('layouts.main_layout')
@section('titulo', 'Alterar')
@section('pagina', 'ALTERAR')
@section('conteudo')
    <div class="container">
        <hr>
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h4>Erro de formulario detectado:</h4>
                    <hr>
                    @foreach ($errors->all() as $mensagem_erro)
                        <p>{{ $mensagem_erro }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{Route('alterar_submissao')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="text_nome" class="form-label">Nome: </label>
                    <input type="text" name="text_nome" id="text_nome" class="form-control" value="{{ old('text_nome',$data[0]['nome']) }}"
                        placeholder="Nome">
                </div>

                <div class="mb-3">
                    <label for="text_email" class="form-label">Email: </label>
                    <input type="email" name="text_email" id="text_email" class="form-control"
                        value="{{ old('text_email',$data[0]['email']) }}" placeholder="exemplo@exemple.com">
                </div>

                <div class="mb-3">
                    <label for="text_senha" class="form-label">Senha: </label>
                    <input type="password" name="text_senha" id="text_senha" class="form-control"
                        value="{{ old('text_senha',$data[0]['senha']) }}" placeholder="Senha">
                </div>

                <div class="mb-3">
                    <label for="text_senha_confirmacao" class="form-label">Confirmação de senha: </label>
                    <input type="password" name="text_senha_confirmacao" id="text_senha_confirmacao" class="form-control"
                        value="{{ old('text_senha_confirmacao',$data[0]['senha']) }}" placeholder="Confirmação de senha">
                </div>

                <input type="hidden" name="id" value=" {{$data[0]['id']}} ">

                <input type="submit" value="Salvar alterações" class="btn btn-primary">
                <a href="{{ Route('listar') }}" class="btn btn-primary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
