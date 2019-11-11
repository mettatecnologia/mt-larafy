<?php

/*
|--------------------------------------------------------------------------
| Comuns Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware(['bloqueia_navegadores_microsoft','auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('verificar-email-perfil/{email}', 'PerfilController@verificarEmailPerfil');
    Route::post('/mudar-senha', 'PerfilController@mudarSenha')->name('mudar-senha');

    Route::group(['namespace'=>'Base'], function () {
        Route::post('validar-senha', 'Controller@validarSenha');
        Route::post('get-session', 'Controller@getSession');
    });

    Route::resource('perfil', 'PerfilController');
    Route::resource('configs', 'CrudConfiguracoesController');
    Route::resource('pessoas', 'CrudPessoasController');
    Route::post('pessoas/alterar-acesso', 'CrudPessoasController@alterarAcesso');


});
