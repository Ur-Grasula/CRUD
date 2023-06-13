<?php

use App\Http\Controllers\Main_Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ROTA PRINCIPAL
Route::get('/', function () {
    return redirect()->route('usuario_listar');
})->name('home');

// ROTA DE LISTAGEM
Route::get('/Listar', [Main_Controller::class, 'View_Usuario_Listar'])->name('usuario_listar');

// ROTA DE BUSCA
Route::match(['post', 'get'],'/Buscar/{usuario?}', [Main_Controller::class, 'View_Usuario_Buscar'])->name('usuario_buscar');

// ROTA DE CADASTRO DE USUARIO
Route::match(['post', 'get'], '/Cadastrar_Validation', [Main_Controller::class, 'View_Usuario_Cadastrar_Validate'])->name('usuario_cadastrar_validate');


// ROTAS DE ALTERAÇÂO
Route::match(['post', 'get'], '/Alterar/{id}', [Main_Controller::class, 'View_usuario_Alterar'])->name('usuario_alterar');
Route::match(['post', 'get'], '/Alterar_Validation/{id}', [Main_Controller::class, 'View_usuari_Alterar_Validate'])->name('usuario_alterar_validate');

// ROTA DE DELETAR
Route::match(['get', 'post'], '/Deletar/{id}', [Main_Controller::class, 'View_Usuario_Deletar'])->name('usuario_deletar');
