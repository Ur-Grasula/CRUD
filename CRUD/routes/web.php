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

// ROTA PRINCIPAL =============================================================================
Route::get('/', [Main_Controller::class, 'Index'])->name('home');

// ROTAS DE CADASTRO DE USUARIO ===============================================================
Route::get('/Cadastrar', [Main_Controller::class, 'Cadastrar'])->name('cadastro');
Route::post('/Cadastrar_Submissao', [Main_Controller::class, 'Cadastrar_Submissao'])->name('cadastrar_submissao');

// ROTA DE LISTAGEM ===========================================================================
Route::get('/Listagem',[Main_Controller::class,'Listagem'])->name('listagem');
