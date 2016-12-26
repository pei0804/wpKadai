<?php

Route::get('/', 'AuthController:login')->name('login');
Route::get('/login', 'AuthController:login')->name('login');
Route::get('/logout', 'AuthController:logout')->name('logout');
Route::post('/login', 'AuthController:doLogin');

Route::group('/report', function(){
    Route::get('/', 'ReportController:index');
    Route::get('/create', 'ReportController:create');
    Route::post('/', 'ReportController:store');
    Route::get('/:id', 'ReportController:show');
    Route::get('/:id/edit', 'ReportController:edit');
    Route::put('/:id', 'ReportController:update');
    Route::get('/:id/delete', 'ReportController:delete');
    Route::delete('/:id', 'ReportController:destroy');
});

// Error
App::notFound(function(){
    View::display('404.twig');
});

