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

Route::namespace ('Base')->group(function () {
    Route::get('verificar-email/{email}/{ignore_user_id?}', 'Controller@verificarEmail');
    Route::get('buscarCidadesPorEstado/{uf}', 'Controller@buscarCidadesPorEstado');
});

Route::middleware(['guest'])->group(function () {
    Route::namespace ('Auth')->group(function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');

        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register');

        Route::prefix('password')->name('password.')->group(function () {
            Route::get('reset', 'ForgotPasswordController@showLinkRequestForm')->name('request');
            Route::post('email', 'ForgotPasswordController@sendResetLinkEmail')->name('email');
            Route::get('reset/{token}', 'ResetPasswordController@showResetForm')->name('reset');
            Route::post('reset', 'ResetPasswordController@reset');
        });
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('verificar-email-perfil/{email}', 'PerfilController@verificarEmailPerfil');
    Route::post('/mudar-senha', 'PerfilController@mudarSenha')->name('mudar-senha');

    Route::post('validar-senha', 'Base\Controller@validarSenha');

    Route::resource('perfil', 'PerfilController');
    Route::resource('configs', 'CrudConfiguracoesController');
    Route::resource('pessoas', 'CrudPessoasController');
    Route::post('pessoas/alterar-acesso', 'CrudPessoasController@alterarAcesso');

});



