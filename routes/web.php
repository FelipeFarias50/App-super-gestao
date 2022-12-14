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

/*Route::get('/', function () {
    return 'Olá, seja bem vindo ao curso!';
});
*/

Route::get('/', 'PrincipalController@principal')->name('site.index')->middleware('log.acesso');
     
Route::get('/sobre-nos', 'SobreNosController@SobreNos')->name('site.sobre-nos'); 
Route::get('/contato', 'ContatoController@Contato')->name('site.contato');

Route::post('/contato', 'ContatoController@salvar')->name('site.contato'); 

Route::get('/login/{erro?}', 'LoginController@index')->name('site.login'); 
Route::post('/login', 'LoginController@autenticar')->name('site.login'); 


Route::middleware('autenticacao:padrao,visitante,p3,p4')->prefix('/app')->group(function() {
    Route::get('/home', 'HomeController@index')->name('app.home');
    Route::get('/sair', 'LoginController@sair')->name('app.sair');
    Route::get('/clientes', 'ClienteController@index')->name('app.clientes');
    Route::get('/fornecedores', 'FornecedorController@index')->name('app.fornecedores');
    Route::get('/produtos', 'ProdutoController@index')->name('app.produtos'); 
});

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('teste');

Route::fallback(function() {
    echo 'A rota acessada não existe.<a href="'.route('site.index').'">clique aqui</a> para ir para página inicial';
});
