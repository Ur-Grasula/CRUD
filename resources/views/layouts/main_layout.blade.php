<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    {{-- MENU --}}
    <div class="container-fluid">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">

                <a class="navbar-brand" href="{{ Route('home') }}">CRUD</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">

                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>

                    {{-- LINKS --}}
                    <div class="offcanvas-body">

                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="{{ Route('usuario_listar') }}">Listar</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal"
                                    data-bs-target="#usuario_cadastrar">Cadastrar</a>
                            </li>

                        </ul>

                        <hr>
                        {{-- FORMULARIO DE BUSCA --}}
                        <form action="{{ Route('usuario_buscar') }}" method="get" class="d-flex mt-3" role="search">
                            @csrf
                            <input class="form-control me-2" type="search" name="buscar" placeholder="Buscar"
                                aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form>

                    </div>

                </div>

            </div>
        </nav>
    </div>

    {{-- TESTE FORMULARIO --}}
    <div class="modal fade" id="usuario_cadastrar" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- FORMULARIO --}}
                    <form action="{{ Route('usuario_cadastrar_validate') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome: </label>
                            <input type="text" name="nome" id="nome" class="form-control"
                                value="{{ old('nome') }}" placeholder="Nome">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email: </label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email') }}" placeholder="exemplo@exemple.com">
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha: </label>
                            <input type="password" name="senha" id="senha" class="form-control"
                                value="{{ old('senha') }}" placeholder="Senha">
                        </div>

                        <div class="mb-3">
                            <label for="senha_confirmacao" class="form-label">Confirmação de senha: </label>
                            <input type="password" name="senha_confirmacao" id="text_senha_confirmacao"
                                class="form-control" value="{{ old('senha_confirmacao') }}"
                                placeholder="Confirmação de senha">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- CONTEUDO --}}
    <div class="container">
        {{-- MENSAGEM DE ERRO  --}}
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        @yield('conteudo')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
