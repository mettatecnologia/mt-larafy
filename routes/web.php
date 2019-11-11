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

Route::get('/', function () { return view('welcome'); });
Route::get('/navegador-invalido', function () { return view('erros/navegador-invalido'); });

Route::middleware(['bloqueia_navegadores_microsoft'])->namespace('Base')->group(function () {
    Route::get('verificar-email/{email}/{ignore_user_id?}', 'Controller@verificarEmail');
    Route::get('buscarCidadesPorEstado/{uf}', 'Controller@buscarCidadesPorEstado');
});

Route::middleware(['bloqueia_navegadores_microsoft','auth'])->group(function () {

});



