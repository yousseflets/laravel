<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/fornecedores', [App\Http\Controllers\Fornecedores\FornecedoresController::class, 'index'])->name('fornecedores.index');
Route::get('/fornecedores/cadastro', [App\Http\Controllers\Fornecedores\FornecedoresController::class, 'create'])->name('fornecedores.create');
Route::post('/fornecedores/cadastro', [App\Http\Controllers\Fornecedores\FornecedoresController::class, 'store'])->name('fornecedores.store');
Route::get('/fornecedores/editar/{id}', [App\Http\Controllers\Fornecedores\FornecedoresController::class, 'edit'])->name('fornecedores.edit');
Route::post('/fornecedores/editar/{id}', [App\Http\Controllers\Fornecedores\FornecedoresController::class, 'update'])->name('fornecedores.update');
Route::get('/fornecedores/deletar/{id}', [App\Http\Controllers\Fornecedores\FornecedoresController::class, 'delete'])->name('fornecedores.delete');

Route::get('/produtos', [App\Http\Controllers\Produtos\ProdutosController::class, 'index'])->name('produtos.index');
Route::get('/produtos/cadastro', [App\Http\Controllers\Produtos\ProdutosController::class, 'create'])->name('produtos.create');
Route::post('/produtos/cadastro', [App\Http\Controllers\Produtos\ProdutosController::class, 'store'])->name('produtos.store');
Route::get('/produtos/editar/{id}', [App\Http\Controllers\Produtos\ProdutosController::class, 'edit'])->name('produtos.edit');
Route::post('/produtos/editar/{id}', [App\Http\Controllers\Produtos\ProdutosController::class, 'update'])->name('produtos.update');
Route::get('/produtos/deletar/{id}', [App\Http\Controllers\Produtos\ProdutosController::class, 'delete'])->name('produtos.delete');
