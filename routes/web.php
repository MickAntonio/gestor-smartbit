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


