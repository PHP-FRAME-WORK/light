<?php

use Light\Router\Route;

/*=============================================================================
=
=  Route::get()->name('')  name 함수 만들어야함, 그래야 redirect 를 구현할수 있음
=
==============================================================================*/

Route::get("admin/order", [\App\Controllers\Admin\OrderController::class, 'insert']);

Route::get('admin/order', [\App\Controllers\Admin\OrderController::class, 'update']);




Route::prefix('admin', function (){

    Route::middleware('auth', function (){

        Route::get("order", [\App\Controllers\Admin\OrderController::class, 'list'] );

    });


});


















