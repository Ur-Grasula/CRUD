<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Main_Controller extends Controller
{
    // METODO DA HOME =======================================================================
    public function Index()
    {
        return view('welcome');
    }

    // METODOS DE INSERT ==================================================================
    public function Cadastrar()
    {
        return view('cadastro_formulario');
    }

    public function Cadastrar_Submissao(Request $request)
    {

        //USAR $request->validate(['field'=>'rule']);
        $nome = $request->input('text_nome');
        $email = $request->input('text_email');
        $senha = $request->input('text_senha');

        echo "
        <p>Nome: $nome</p>
        <p>Email: $email</p>
        <p>Senha: $senha</p>
        ";
    }

    // METODO DE READ ===================================================================

    // METODO DE UPDATE =================================================================

    // METODO DE DELETE =================================================================
}
