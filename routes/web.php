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

    Route::get('/', 'Administrador\PagesController@dashboard');
    

    // JSON Lista de Municípios
    Route::get('json/lista-de-municipios/{provincia}', 'General\MunicipioController@jsonListaDeMunicipios');


});
