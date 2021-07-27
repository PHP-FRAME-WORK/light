<?php

use Light\Router\Route;


Route::prefix('admin', function (){

    Route::middleware('auth', function (){

        Route::get("order", [\App\Controllers\Admin\OrderController::class, 'list'] );

    });


});


Route::get("admin/order", [\App\Controllers\Admin\OrderController::class, 'insert']);







