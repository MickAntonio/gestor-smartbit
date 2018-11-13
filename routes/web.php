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

// My middleware

Route::group(["middleware" => "Secretaria"], function ()
{
    Route::get('/', 'Secretaria\DashboardController@dashboard');
    Route::get('Secretary', 'Secretaria\DashboardController@dashboard')->name("Secre");
    Route::get('Secretary/CourseList', 'Secretaria\DashboardController@ListCurso')->name("CourseList");
    Route::get('Secretary/ClassList', 'Secretaria\DashboardController@Listturma')->name("ClassList");
    Route::get("Secretary/Inscription","Secretaria\matriculaController@Inscricao")->name("Inscription");
});

Route::group(["middleware" => ["Administrador"]], function ()
{
    Route::get('Administrador', 'Administrador\DashboardController@dashboard')->name("Adm");
    Route::get('Administrador/NewClass', 'Administrador\DashboardController@setTurma')->name("NewClass");
    Route::get('Administrador/ListClass', 'Administrador\DashboardController@ListTurma')->name("ListClass");

    Route::get('Administrador/NewCourse', 'Administrador\DashboardController@setCurso')->name("NewCourse");
    Route::get('Administrador/ListCourse', 'Administrador\DashboardController@ListCurso')->name("ListCourse");
    
    Route::post("Administrador/AddCourse","Administrador\PostCursoController@store")->name("AddCourse");
    Route::post("Administrador/AddClass","Administrador\PostTurma@store")->name("AddClass");
});

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
        Route::resource('/alunos-propinas-pagamentos', 'Secretaria\AlunosPropinasPagamentosController', ['except'=>['create', 'edit']]);       
        Route::get('/lista-de-alunos', 'Secretaria\AlunosPropinasPagamentosController@alunos');       
        Route::get('/preco-propina/{curso}/{classe}', 'Secretaria\AlunosPropinasPagamentosController@getPrecoPropina');       
        Route::get('/propina-recibo/{id}', 'Secretaria\AlunosPropinasPagamentosController@pdfRecibo');  
        
        //
        Route::get('/relatorios/pagamentos-de-propinas', 'Secretaria\Relatorios\PropinasPagamentosController@index');       
        Route::get('/relatorios/pagamentos-de-propinas-pdf/{id}', 'Secretaria\Relatorios\PropinasPagamentosController@pdfPagamentos');       

        Route::post('/relatorios/outras-entradas-pdf',  ['as'=>'outras.entradas.pdf', 'uses'=>'Secretaria\EntradasPagamentosController@pdfRelatorio']);
        Route::post('/relatorios/outras-saidas-pdf',  ['as'=>'outras.saidas.pdf', 'uses'=>'Secretaria\SaidasPagamentosController@pdfRelatorio']);
                          
    });

    Route::prefix('administrador')->group(function(){
        Route::get('/', 'Administrador\DashboardController@dashboard');
    });

    
    Route::get('/json/lista-de-meses', 'Secretaria\AlunosPropinasPagamentosController@jsonListaDeMeses');       

});


