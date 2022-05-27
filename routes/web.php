<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ClientesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Home');
});
Route::get('/Produtos/Novo',[ProdutosController::class,'Cadastrar']);
Route::post('/Produtos/Salvar',[ProdutosController::class,'Salvar']);
Route::get('/Cliente/Novo',[ClientesController::class,'Cadastrar']);

