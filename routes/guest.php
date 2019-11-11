<?php

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware(['bloqueia_navegadores_microsoft','guest'])->group(function () {
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
