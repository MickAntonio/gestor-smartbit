<?php

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



Route::group(['middleware'=>['web']], function(){

    Route::get('/', 'Administrador\DashboardController@dashboard');

    Route::prefix('secretaria')->group(function(){
        Route::get('/', 'Secretaria\DashboardController@dashboard');       
        Route::resource('/precos', 'Secretaria\PrecosController', ['except'=>['create', 'edit', 'show']]);       
        Route::resource('/preco-das-propinas', 'Secretaria\PrecoClassesController', ['except'=>['create', 'edit', 'show']]);  
        Route::resource('/tipos-de-pagamentos', 'Secretaria\TipoPagamentosController', ['except'=>['create', 'edit', 'show']]);       
        Route::resource('/entradas-pagamentos', 'Secretaria\EntradasPagamentosController', ['except'=>['create', 'edit', 'show']]);       
        Route::resource('/saidas-pagamentos', 'Secretaria\SaidasPagamentosController', ['except'=>['create', 'edit', 'show']]);       
        Route::resource('/alunos-outros-pagamentos', 'Secretaria\AlunosOutrosPagamentosController', ['except'=>['create', 'edit', 'show']]);       
        Route::resource('/alunos-propinas-pagamentos', 'Secretaria\AlunosPropinasPagamentosController', ['except'=>['create', 'edit', 'show']]);       
        Route::resource('/lista-de-alunos', 'Secretaria\AlunosPropinasPagamentosController', ['except'=>['create', 'edit', 'show']]);       
        Route::get('/lista-de-alunos', 'Secretaria\AlunosPropinasPagamentosController@alunos');       
             
    });

    Route::prefix('administrador')->group(function(){
        Route::get('/', 'Administrador\DashboardController@dashboard');
    });
    

    // JSON Lista de Municípios
    Route::get('json/lista-de-municipios/{provincia}', 'General\MunicipioController@jsonListaDeMunicipios');


});
