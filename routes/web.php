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
    Route::get('/', 'Secretaria\DashboardController@dashboard')->name("Secre");

    Route::get('/renderiza', 'Administrador\MatriculaController@renderiza');
    /* Routas para curso e turmas */
    Route::get('/listar-curso', 'Secretaria\DashboardController@ListCurso')->name("CourseList");
    Route::get('listar-turmas', 'Secretaria\DashboardController@Listturma')->name("ClassList");
    /* Routas para inscrição pela 1ª vez */
    Route::resource('inscricao-pela-primeira-vez', 'Secretaria\InscricaoController', ['except'=>['create', 'edit', 'show']]);  
    Route::get('lista-de-candidatos-inscritos', 'Secretaria\InscricaoController@listaCandidatoInscritos');

    /* Routas para matricula anonima */
    Route::post("/matricula-anonima","Secretaria\InscricaoController@MatriculaAnonima")->name("MatriculaAnonima");
    /* já matriculados pela direcção */
    Route::get("/Lista-de-alunos-matriculados","Administrador\MatriculaController@listaAlunosMatriculados");
    Route::get("/Lista-de-alunos-matriculados/{date}","Administrador\MatriculaController@listaAlunosMatriculados");
    /* Routas para confirmação de matricula */
    Route::resource("/confirmar-matricula","Administrador\ConfirmacaoController",['except'=>['create', 'edit', 'show']]);
    Route::get("/confirmar-matricula/{processo}","Administrador\ConfirmacaoController@index")->name("confirmar"); 

    Route::get("/Lista-de-alunos-com-matricula-confirmada","Secretaria\DashboardController@listaAlunosConfirmados");
    Route::get("/Lista-de-alunos-com-matricula-confirmada/{date}","Secretaria\DashboardController@listaAlunosConfirmados");

    Route::get("/pagamento-de-confirmacao-de-matricula","Administrador\ConfirmacaoController@ConfirmacaoPagamento");
});

Route::prefix("Administrador")->group(function ()
{
    Route::get('/', 'Administrador\DashboardController@dashboard')->name("Adm");
    /* Routas para a turma */
    Route::get('/listar-turmas-recentes', 'Administrador\PostTurma@ListTurma')->name("ListClass");
    Route::get('/listar-turmas-antigas/{ano}', 'Administrador\PostTurma@ListTurmaAntigas')->name("ListOldClass");
    Route::get('/listar-turmas-antigas', 'Administrador\PostTurma@ListTurmaAntigas')->name("ListOldClass");
    Route::get('/listar-turmas-futuras', 'Administrador\PostTurma@ListTurmaFuturas')->name("ListNextClass");

    Route::resource('/criar-turma', 'Administrador\PostTurma', ['except'=>['create', 'edit', 'show']]);   
    /* matricula */
    Route::resource("/atribuir-turma-ao-aluno","Administrador\MatriculaController",['except'=>['create', 'edit', 'show']])->names(["index"=>"AtribuirTurmaAluno","store"=>"AtribuirTurmaAluno"]);
    Route::get("/Listas-de-todos-alunos-matriculados.pdf/{date}","Administrador\MatriculaController@PdfAllMatriculados")->name("PdfAllMatriculados");

    Route::get('/lista-da-turma/{idturma}', 'Administrador\Postturma@AlunosDaTurma')->name("AlunosDaTurma");
    /* Routa para alunos vs turmas */
    Route::get('/Ficha-do-aluno/{id}', 'Administrador\MatriculaController@FichaMatricula')->name("FichaAluno");
    Route::get('/lista-dos-alunos-da-turma/{idturma}', 'Administrador\PostTurma@ListaDosAlunos')->name("ListaDosAlunos");    

    Route::get('/json-turma/{idclasse}/{idcurso}', 'Administrador\Postturma@JsonTurma')->name("JsonTurma");

    /* Routas para o cursos */
    Route::resource('/cadastrar-curso', 'Administrador\PostCursoController', ['except'=>['create', 'edit', 'show']]); 
    Route::get('/listar-curso', 'Administrador\PostCursoController@ListCurso')->name("ListCourse");
    
    /* confirmao de matricula */
    Route::get("/Lista-de-alunos-com-matricula-confirmada/{date}","Administrador\ConfirmacaoController@listaAlunosConfirmados")->name("ConfirmacaoRecentes");
    Route::get("/Lista-de-alunos-com-matricula-confirmada","Administrador\ConfirmacaoController@listaAlunosConfirmados")->name("ConfirmacaoRecentes");

    Route::get("/Listas-de-todos-alunos-que-confirmaram-matricula.pdf/{date}","Administrador\ConfirmacaoController@PdfAllConfirmados")->name("PdfAllConfirmados");
    
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



Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

