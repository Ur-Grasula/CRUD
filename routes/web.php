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
Route::get('/', [Main_Controller::class, 'Index'])->name('home');

// ROTAS DE CADASTRO DE USUARIO
Route::get('/Cadastrar', [Main_Controller::class, 'Cadastrar'])->name('cadastrar');
Route::match(['post', 'get'], '/Cadastrar_Submissao', [Main_Controller::class, 'Cadastrar_Submissao'])->name('cadastrar_submissao');

// ROTA DE LISTAGEM
Route::get('/Listar', [Main_Controller::class, 'Listar'])->name('listar');

// ROTAS DE ALTERAÇÂO
Route::get('/Alterar/{id}', [Main_Controller::class, 'Alterar'])->name('alterar');
Route::match(['post', 'get'], '/Alterar_Submissao', [Main_Controller::class, 'Alterar_Submissao'])->name('alterar_submissao');

// ROTA DE DELETAR
Route::match(['get','post'],'/Deletar/{id}', [Main_Controller::class, 'Deletar'])->name('deletar');
