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

    Route::get('/', 'General\DashboardController@index');

     Route::prefix('admin')->group(function(){
        Route::resource('/funcionario', 'General\FuncionarioController');
        Route::resource('/fornecedor', 'General\FornecedorController');
        Route::resource('/cliente', 'General\ClienteController');
        Route::resource('/categoria', 'General\CategoriaController');
        Route::resource('/sub-categoria', 'General\SubCategoriaController');
        Route::resource('/tipo-de-atributo', 'General\TipoAtributoController');
        Route::resource('/atributo', 'General\atributoController');
        Route::resource('/produtos', 'General\ProdutoController');
        Route::resource('/compras', 'General\CompraController');
        Route::resource('/usos', 'General\UsoController');
        Route::resource('/vendas', 'General\VendaController');
        Route::resource('/vendas-balcao', 'General\VendaBalcaoController');
        Route::resource('/marcacoes', 'General\MarcacoesController');
        Route::resource('/servicos', 'General\ServicosController');
        Route::resource('/pagamentos', 'General\PagamentosController');

        
        
    });

    

    // JSON Lista de Municípios
    Route::get('json/lista-de-municipios/{provincia}', 'General\MunicipioController@jsonListaDeMunicipios');
    Route::get('json/lista-de-sub-categorias/{categoria}', 'General\SubCategoriaController@jsonListaDeSuCategorias');
    Route::get('json/lista-de-atributos/{tipo}', 'General\AtributoController@jsonListaDeAtributos');
    Route::get('json/lista-de-produtos', 'General\ProdutoController@jsonListaDeProdutos');
    Route::get('json/lista-de-servicos', 'General\ServicosController@jsonListaDeServicos');
    Route::get('json/produto/{id}', 'General\ProdutoController@jsonProduto');
    

    // Html Texts Returns
    Route::get('html/produto-estoque/{id}', 'General\CompraController@atributos');
    Route::get('html/produto-estoque-preco/{id}', 'General\CompraController@atributosPreco');
    Route::get('html/produto-venda/{id}', 'General\VendaController@atributos');
    Route::get('html/produto-venda-preco/{id}', 'General\VendaController@atributosPreco');
    Route::get('html/servicos-preco/{id}', 'General\ServicosController@servicoPreco');

    // PDF ROUTES
    Route::get('clientes/pdf', 'General\ClienteController@pdfLista');
    Route::get('fornecedores/pdf', 'General\FornecedorController@pdfLista');
    Route::get('funcionarios/pdf', 'General\FuncionarioController@pdfLista');
    Route::get('produtos/pdf', 'General\ProdutoController@pdfLista');
    Route::get('servicos/pdf', 'General\ServicosController@pdfLista');

    Route::post('marcacoes/pdf', ['as'=>'marcacoes.pdf', 'uses'=>'General\MarcacoesController@pdfLista']);
    Route::post('pagamentos/pdf', ['as'=>'pagamentos.pdf', 'uses'=>'General\PagamentosController@pdfLista']);
    Route::post('usos/pdf', ['as'=>'usos.pdf', 'uses'=>'General\UsoController@pdfLista']);
    Route::post('vendas/pdf', ['as'=>'vendas.pdf', 'uses'=>'General\VendaController@pdfLista']);


});
