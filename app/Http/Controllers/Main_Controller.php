<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Mockery\Generator\Method;
use Throwable;

use function GuzzleHttp\Promise\all;

date_default_timezone_set('America/Sao_Paulo');

class Main_Controller extends Controller
{
    // CRUD ===============================================================================================

    // FUNÇÃO RESPONSAVEL POR SALVAR DADOS
    private function Create_Usuario($data)
    {
        try {
            $usuario = new Usuario;
            $usuario->nome = $data['nome'];
            $usuario->email = $data['email'];
            $usuario->senha = $data['senha'];
            $usuario->created_at = NOW();
            $usuario->updated_at = NOW();
            $usuario->save();
        } catch (\Exception $exception) {
            $erro_code = $exception->getCode();
            abort(403, "Erro ao tentar salvar dados.");
        }
    }

    // FUNÇÃO RESPONSAVEL POR BUSCAR DADOS
    private function Read_Usuario(int $id)
    {
        try {
            $data = Usuario::find($id);
            return $data;
        } catch (\Exception $exception) {
            $erro_code = $exception->getCode();
            abort(403, "Erro ao tentar recuperar dados.");
        }
    }

    // FUNÇÃO RESPONSAVEL PELO UPDATE DE DADOS
    private function Update_Usuario($data)
    {
        try {
            $usuario =  Usuario::find($data['id']);
            $usuario->nome = $data['nome'];
            $usuario->email = $data['email'];
            $usuario->senha = $data['senha'];
            $usuario->updated_at = \Carbon\Carbon::now();
            $usuario->save();
        } catch (\Exception $exception) {
            abort(404, "Erro ao tentar atualizar dados.");
        }
    }

    // FUNÇÃO RESPONSAVEL POR EXCLUIR DADOS
    private function Delete_Usuario($id)
    {
        try {
            $usuario = Usuario::find($id);
            $usuario->delete();
        } catch (\Exception $exception) {
            abort(404, "Erro ao tentar excluir dados.");
        }
    }

    // FUNÇÃO RESPONSAVEL POR LISTAR DADOS
    private function List_Usuario()
    {
        try {
            $data['registro'] = Usuario::count();
            $data['usuario'] = Usuario::orderBy('created_at', 'desc')->get();
            return $data;
        } catch (\Exception $exception) {
            abort(403, "Erro ao tentar listar dados.");
        }
    }

    // FUNÇÃO RESPONSAVEL POR BUSCAR DADOS POR NOME
    private function Buscar_Usuario($buscar)
    {
        try {
            $data['registro'] = Usuario::where('nome', 'like', $buscar . '%')->count();
            $data['usuario'] = Usuario::where('nome', 'like', $buscar . '%')->get();
            return $data;
        } catch (\Exception $exception) {
            abort(403, "Erro ao tentar buscar dados.");
        }
    }


    // VIEW ================================================================================================

    // FUNÇÃO RESPONSAVEL POR RETORNAR DADOS PARA VIEW (usuario_buscar)
    public function View_Usuario_Buscar(Request $request)
    {
        if ($request->isMethod('get')) {

            $request->validate([
                'buscar' => ['required', 'min:1', 'max:50'],
            ]);

            $buscar = $request->input('buscar');
            $data = $this->Buscar_Usuario($buscar);

            return view('usuario_buscar', ['data' => $data]);
        } else {
            return redirect()->route('usuario_listar');
        }
    }

    // FUNÇÃO RESPONSAVEL POR RETORNAR DADOS PARA VIEW (usuario_listar)
    public function View_Usuario_Listar()
    {
        $data = $this->List_Usuario();
        return view('usuario_listar', ['data' => $data]);
    }

    // FUNÇÃO RESPONSAVEL POR VALIDAR CAMPOS DO FORMULARIO DE CADASTRO
    public function View_Usuario_Cadastrar_Validate(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate(
                [
                    // REGRAS DE VALIDAÇÂO DO CAMPO (text_nome)
                    'nome' => ['required', 'min:3', 'max:50'],

                    // REGRAS DE VALIDAÇÂO DO CAMPO (text_email)
                    'email' => ['required', 'min:12', 'max:30'],

                    // REGRAS DE VALIDAÇÂO DO CAMPO (text_senha)
                    'senha' => ['required', 'min:8', 'max:20'],

                    // REGRAS DE VALIDAÇÂO DO CAMPO (text_senha_confirmacao)
                    'senha_confirmacao' => ['required', 'min:8', 'max:20', 'same:senha'],
                ],
                [
                    // MENSAGENS DO CAMPO (text_nome)
                    'nome.required' => "É necessario preencher o campo Nome.",
                    'nome.min' => "O campo Nome precisa conter pelo menos 3 caracteres.",
                    'nome.max' => "O campo Nome pode ter no maximo 50 caracteres.",

                    // MENSAGENS DO CAMPO (text_email)
                    'email.required' => "É necessario preencher o campo Email.",
                    'email.min' => "O campo Email precisa conter pelo menos 12 caracteres.",
                    'email.max' => "O campo Email pode ter no maximo 20 caracteres.",

                    // MENSAGENS DO CAMPO (text_senha)
                    'senha.required' => "É necessario preencher o campo Senha.",
                    'senha.min' => "O campo Senha precisa conter pelo menos 8 caracteres.",
                    'senha.max' => "O campo Senha pode ter no maximo 20 caracteres.",

                    // MENSAGENS DO CAMPO (text_senha_confirmacao)
                    'senha_confirmacao.required' => "É necessario preencher o campo Confirmação de senha.",
                    'senha_confirmacao.min' => "O campo Confirmação de senha precisa conter pelo menos 8 caracteres.",
                    'senha_confirmacao.max' => "O campo Confirmação de senha pode ter no maximo 20 caracteres.",
                    'senha_confirmacao.same' => "O campo Confirmação de senha precisa ser igual ao campo Senha."
                ]
            );

            $data = [
                'nome' => $request->input('nome'),
                'email' => $request->input('email'),
                'senha' => $request->input('senha'),
            ];

            $this->Create_Usuario($data);

            return redirect()->route('usuario_listar');
        } else {
            return redirect()->route('usuario_listar');
        }
    }

    // FUNÇÃO RESPONSAVEL POR RETORNAR DADOS PARA A VIEW (usuario_alterar)
    public function View_usuario_Alterar(Request $request, int $id)
    {
        if ($request->isMethod('get')) {
            $data = $this->Read_Usuario($id);
            return view('usuario_alterar', ['data' => $data]);
        } else {
            return redirect()->route('usuario_listar');
        }
    }

    // FUNÇÃO RESPONSAVEL POR VALIDAR CAMPOS DO FORMULARIO ALTERAÇÃO
    public function View_usuari_Alterar_Validate(Request $request, int $id)
    {
        if ($request->isMethod('post')) {

            $request->validate(
                [
                    'nome' => ['required', 'min:3', 'max:50'],
                    'email' => ['required', 'min:12', 'max:30'],
                    'senha' => ['required', 'min:8', 'max:20'],
                    'senha_confirmacao' => ['required', 'min:8', 'max:20', 'same:senha'],
                ],
                [
                    'nome.required' => "É necessario preencher o campo Nome.",
                    'nome.min' => "O campo Nome precisa conter pelo menos 3 caracteres.",
                    'nome.max' => "O campo Nome pode ter no maximo 50 caracteres.",

                    'email.required' => "É necessario preencher o campo Email.",
                    'email.min' => "O campo Email precisa conter pelo menos 12 caracteres.",
                    'email.max' => "O campo Email pode ter no maximo 20 caracteres.",

                    'senha.required' => "É necessario preencher o campo Senha.",
                    'senha.min' => "O campo Senha precisa conter pelo menos 8 caracteres.",
                    'senha.max' => "O campo Senha pode ter no maximo 20 caracteres.",

                    'senha_confirmacao.required' => "É necessario preencher o campo Confirmação de senha.",
                    'senha_confirmacao.min' => "O campo Confirmação de senha precisa conter pelo menos 8 caracteres.",
                    'senha_confirmacao.max' => "O campo Confirmação de senha pode ter no maximo 20 caracteres.",
                    'senha_confirmacao.same' => "O campo Confirmação de senha precisa ser igual ao campo Senha."
                ]
            );

            $data = [
                'id' => $id,
                'nome' => $request->input('nome'),
                'email' => $request->input('email'),
                'senha' => $request->input('senha'),
            ];

            $this->Update_Usuario($data);
            return redirect()->route('usuario_listar');
        } else {
            return redirect()->route('usuario_listar');
        }
    }

    // FUNÇÃO RESPONSAVEL POR VALIDAR EXCLUSÃO DE DADOS
    public function View_Usuario_Deletar(Request $request, int $id)
    {
        if ($request->isMethod('post')) {
            $this->Delete_Usuario($id);
            return redirect()->route('usuario_listar');
        } else {
            return redirect()->route('usuario_listar');
        }
    }
}
