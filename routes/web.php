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

    Route::prefix("Secretaria")->group(function ()
{
    Route::get('/test', 'Secretaria\DashboardController@index')->name("Secre");
    Route::get('/', 'Secretaria\DashboardController@dashboard')->name("Secre");
    Route::get('/listar-curso', 'Secretaria\DashboardController@ListCurso')->name("CourseList");
    Route::get('listar-turmas', 'Secretaria\DashboardController@Listturma')->name("ClassList");
    Route::resource('inscricao-pela-primeira-vez', 'Secretaria\InscricaoController', ['except'=>['create', 'edit', 'show']]);  
    Route::get('lista-de-candidatos-inscritos', 'Secretaria\InscricaoController@listaCandidatoInscritos');   

    Route::post("/matricula-anonima","Secretaria\InscricaoController@MatriculaAnonima")->name("MatriculaAnonima"); 

    Route::resource("/confirmar-matricula","Administrador\ConfirmacaoController",['except'=>['create', 'edit', 'show']]);
});

Route::prefix("Administrador")->group(function ()
{
    Route::get('/', 'Administrador\DashboardController@dashboard')->name("Adm");
    Route::get('/listar-turmas', 'Administrador\PostTurma@ListTurma')->name("ListClass");
    Route::get('/listar-turmas-antigas', 'Administrador\PostTurma@ListTurmaAntigas')->name("ListOldClass");
    Route::resource('/criar-turma', 'Administrador\PostTurma', ['except'=>['create', 'edit', 'show']]);   

    Route::resource('/cadastrar-curso', 'Administrador\PostCursoController', ['except'=>['create', 'edit', 'show']]); 
    Route::get('/listar-curso', 'Administrador\PostCursoController@ListCurso')->name("ListCourse");
    
    Route::resource("/atribuir-turma-ao-aluno","Administrador\MatriculaController",['except'=>['create', 'edit', 'show']])->names(["index"=>"AtribuirTurmaAluno","store"=>"AtribuirTurmaAluno"]);
    Route::get('/lista-da-turma/{idturma}', 'Administrador\Postturma@AlunosDaTurma')->name("AlunosDaTurma");
    Route::get('/Ficha-do-aluno/{id}', 'Administrador\MatriculaController@FichaMatricula')->name("FichaAluno");
    Route::get('/lista-dos-alunos-da-turma/{idturma}', 'Administrador\PostTurma@ListaDosAlunos')->name("ListaDosAlunos");    

    Route::get('/json-turma/{idclasse}/{idcurso}', 'Administrador\Postturma@JsonTurma')->name("JsonTurma");
});
 // ==================================================================================================

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
                          
    });

   // Route::prefix('administrador')->group(function(){
     //   Route::get('/', 'Administrador\DashboardController@dashboard');
   // });
    
    Route::get('/json/lista-de-meses', 'Secretaria\AlunosPropinasPagamentosController@jsonListaDeMeses');       

});


