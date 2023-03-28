<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Mockery\Generator\Method;
use Throwable;

use function GuzzleHttp\Promise\all;

class Main_Controller extends Controller
{
    // METODO RESPOSAVEL POR RETORNAR A VIEW
    public function Index()
    {
        return view('welcome');
    }

    // METODO RESPONSAVEL POR RETORNAR A VIEW
    public function Cadastrar()
    {
        return view('cadastrar_formulario');
    }

    // METODO RESPONSAVEL POR VALIDAÇÔES DE CAMPOS DE FORMULARIO E CADASTRO DE USUARIO
    public function Cadastrar_Submissao(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate(
                [
                    // REGRAS DE VALIDAÇÂO DO CAMPO (text_nome)
                    'text_nome' => ['required', 'min:3', 'max:50'],

                    // REGRAS DE VALIDAÇÂO DO CAMPO (text_email)
                    'text_email' => ['required', 'min:12', 'max:30'],

                    // REGRAS DE VALIDAÇÂO DO CAMPO (text_senha)
                    'text_senha' => ['required', 'min:8', 'max:20'],

                    // REGRAS DE VALIDAÇÂO DO CAMPO (text_senha_confirmacao)
                    'text_senha_confirmacao' => ['required', 'min:8', 'max:20', 'same:text_senha'],

                ],
                [
                    // MENSAGENS DO CAMPO (text_nome)
                    'text_nome.required' => "É necessario preencher o campo Nome.",
                    'text_nome.min' => "O campo Nome precisa conter pelo menos 3 caracteres.",
                    'text_nome.max' => "O campo Nome pode ter no maximo 50 caracteres.",

                    // MENSAGENS DO CAMPO (text_email)
                    'text_email.required' => "É necessario preencher o campo Email.",
                    'text_email.min' => "O campo Email precisa conter pelo menos 12 caracteres.",
                    'text_email.max' => "O campo Email pode ter no maximo 20 caracteres.",

                    // MENSAGENS DO CAMPO (text_senha)
                    'text_senha.required' => "É necessario preencher o campo Senha.",
                    'text_senha.min' => "O campo Senha precisa conter pelo menos 8 caracteres.",
                    'text_senha.max' => "O campo Senha pode ter no maximo 20 caracteres.",

                    // MENSAGENS DO CAMPO (text_senha_confirmacao)
                    'text_senha_confirmacao.required' => "É necessario preencher o campo Confirmação de senha.",
                    'text_senha_confirmacao.min' => "O campo Confirmação de senha precisa conter pelo menos 8 caracteres.",
                    'text_senha_confirmacao.max' => "O campo Confirmação de senha pode ter no maximo 20 caracteres.",
                    'text_senha_confirmacao.same' => "O campo Confirmação de senha precisa ser igual ao campo Senha."
                ]
            );

            $nome = $request->input('text_nome');
            $email = $request->input('text_email');
            $senha = $request->input('text_senha');

            // CADASTRO ORM ELOQUENT
            $usuario =  new Usuario();
            $usuario->nome = $nome;
            $usuario->email = $email;
            $usuario->senha = $senha;
            $usuario->created_at = \Carbon\Carbon::now();
            $usuario->updated_at = \Carbon\Carbon::now();

            try {
                if ($usuario->save()) {
                    $status = '1';
                    return redirect()->route('cadastrar')->with(['status' => $status]);
                }
            } catch (\Exception $e) {
                $mensagem = $e->getMessage();
                $status = '0';
                return redirect()->route('cadastrar')->with(['status' => $status, 'mensagem' => $mensagem]);
            }
        } else {
            return redirect()->route('cadastrar');
        }
    }

    // METODO RESPONSAVEL POR BUSCAR REGISTROS NO BANCO DE DADOS E RETORNA PARA VIEW
    public function Listar()
    {
        try {
            $registro = Usuario::count();

            $data[] = [];

            if ($registro > 0) {

                $data = Usuario::orderBy('created_at', 'desc')->get()->all();
            }

            return view('listar', ['data' => $data, 'registro' => $registro]);
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    // METODO RESPONSAVEL POR RETORNAR DADOS DE USUARIO PARA FORMULARIO DA VIEW
    public function Alterar(Request $request, int $id)
    {
        if ($request->isMethod('get')) {

            $registro = Usuario::where('id', '=', $id)->count();


            if ($registro == 1) {

                $data = Usuario::where('id', '=', $id)->get()->all();
            } else {
                return redirect()->route('listar');
            }
        } else {

            return redirect()->route('listar');
        }
        return view('alterar_formulario', ['data' => $data]);
    }

    // METODO RESPONSAVEL POR VALIDAÇÔES DE CAMPOS DE FORMULARIO E ALTERAÇÂO DE USUARIO
    public function Alterar_Submissao(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate(
                [
                    // REGRAS DE VALIDAÇÂO DO CAMPO (text_nome)
                    'text_nome' => ['required', 'min:3', 'max:50'],

                    // REGRAS DE VALIDAÇÂO DO CAMPO (text_email)
                    'text_email' => ['required', 'min:12', 'max:30'],

                    // REGRAS DE VALIDAÇÂO DO CAMPO (text_senha)
                    'text_senha' => ['required', 'min:8', 'max:20'],

                    // REGRAS DE VALIDAÇÂO DO CAMPO (text_senha_confirmacao)
                    'text_senha_confirmacao' => ['required', 'min:8', 'max:20', 'same:text_senha'],

                ],
                [
                    // MENSAGENS DO CAMPO (text_nome)
                    'text_nome.required' => "É necessario preencher o campo Nome.",
                    'text_nome.min' => "O campo Nome precisa conter pelo menos 3 caracteres.",
                    'text_nome.max' => "O campo Nome pode ter no maximo 50 caracteres.",

                    // MENSAGENS DO CAMPO (text_email)
                    'text_email.required' => "É necessario preencher o campo Email.",
                    'text_email.min' => "O campo Email precisa conter pelo menos 12 caracteres.",
                    'text_email.max' => "O campo Email pode ter no maximo 20 caracteres.",

                    // MENSAGENS DO CAMPO (text_senha)
                    'text_senha.required' => "É necessario preencher o campo Senha.",
                    'text_senha.min' => "O campo Senha precisa conter pelo menos 8 caracteres.",
                    'text_senha.max' => "O campo Senha pode ter no maximo 20 caracteres.",

                    // MENSAGENS DO CAMPO (text_senha_confirmacao)
                    'text_senha_confirmacao.required' => "É necessario preencher o campo Confirmação de senha.",
                    'text_senha_confirmacao.min' => "O campo Confirmação de senha precisa conter pelo menos 8 caracteres.",
                    'text_senha_confirmacao.max' => "O campo Confirmação de senha pode ter no maximo 20 caracteres.",
                    'text_senha_confirmacao.same' => "O campo Confirmação de senha precisa ser igual ao campo Senha."
                ]
            );

            $nome = $request->input('text_nome');
            $email = $request->input('text_email');
            $senha = $request->input('text_senha');
            $id = $request->input('id');

            // UPDATE ORM ELOQUENT
            $usuario =  Usuario::find($id);
            $usuario->nome = $nome;
            $usuario->email = $email;
            $usuario->senha = $senha;
            $usuario->updated_at = \Carbon\Carbon::now();
            $usuario->save();

            return redirect()->route('listar');
        } else {
            return redirect()->route('listar');
        }
    }

    // METODO DE DELETE
    public function Deletar(Request $request, int $id)
    {
        try {
            if ($request->isMethod('post')) {
                $usuario = Usuario::find($id);
                $usuario->delete();
                return redirect()->route('listar');
            } else {
                return redirect()->route('listar');
            }
        } catch (\Exception $e) {
            // return $e->getMessage();
        }
    }
}
