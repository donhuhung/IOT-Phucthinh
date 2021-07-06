<?php

Route::group([
    'middleware' => ['web'],
    'version' => 'v1',
    'prefix' => Config::get('cms.apiUri')
], function () {
    //API for User
    Route::prefix('user')->group(function () {
        Route::post('login', 'PhucThinh\Api\Controllers\User@login');
        Route::post('forgot-password', 'Mtech\Api\Controllers\User@forgotPassWord');
        Route::post('logout', 'Mtech\Api\Controllers\User@logout');
    });
    Route::middleware('PhucThinh\Api\Middleware\JwtMiddleware')->prefix('factory')->group(function () {    
        Route::get('list', 'PhucThinh\Api\Controllers\Factory@getList');        
    });
    Route::middleware('PhucThinh\Api\Middleware\JwtMiddleware')->prefix('sensor')->group(function () {    
        Route::post('list', 'PhucThinh\Api\Controllers\Device@getListSenSor');        
    });
    Route::middleware('PhucThinh\Api\Middleware\JwtMiddleware')->prefix('device')->group(function () {    
        Route::post('list', 'PhucThinh\Api\Controllers\Device@getListDevice');        
    });
    
});
