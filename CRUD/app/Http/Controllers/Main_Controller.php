<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class Main_Controller extends Controller
{
    // METODO DA HOME =======================================================================
    public function Index()
    {
        return view('welcome');
    }

    // METODOS DE INSERT ====================================================================
    public function Cadastrar()
    {
        return view('cadastro_formulario');
    }

    public function Cadastrar_Submissao(Request $request)
    {
        // VALIDAÇÂO DE DADOS DE FORMULARIO
        $request->validate(
            [
                // REGRAS DE VALIDAÇÂO DO CAMPO (text_nome)
                'text_nome' => ['required', 'min:3', 'max:50'],

                // REGRAS DE VALIDAÇÂO DO CAMPO (text_email)
                'text_email' => ['required', 'min:3', 'max:30'],

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

        // VARIAVEIS COM INPUTS
        $nome = $request->input('text_nome');
        $email = $request->input('text_email');
        $senha = $request->input('text_senha');

        // CADASTRO USANDO ORM ELOQUENT
        $usuario =  new Usuario();
        $usuario->nome = $nome;
        $usuario->email = $email;
        $usuario->senha = $senha;
        $usuario->created_at = \Carbon\Carbon::now();
        $usuario->updated_at = \Carbon\Carbon::now();
        $usuario->save();

        // REDIRECIONA PARA VIEW (cadastro_formulario)
        return redirect()->route('cadastro');
    }

    // METODO DE READ ===================================================================
    public function Listagem()
    {
        // BUSCA QUANTIDADE DE REGISTROS
        $registro = Usuario::count();

        //PREPARA ARRAY VAZIO CASO REGISTROS < 1
        $data[]=[];

        // CASO NUMERO DE REGISTROS MAIOR QUE 0
        if ($registro > 0) {
            // BUSCA TODOS O REGISTRO NO BANCO DE DADOS
            $data = Usuario::get()->all();
        }

        // RETORNA DATA PARA VIEW
        return view('listagem',['data'=>$data,'registro' => $registro]);
    }

    // METODO DE UPDATE =================================================================

    // METODO DE DELETE =================================================================
}
