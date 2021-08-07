<?php

Route::group([
    'middleware' => ['web'],
    'version' => 'v1',
    'prefix' => Config::get('cms.apiUri')
        ], function () {
    //API for User
    Route::prefix('user')->group(function () {
        Route::post('login', 'PhucThinh\Api\Controllers\User@login');
        Route::post('forgot-password', 'PhucThinh\Api\Controllers\User@forgotPassWord');
        Route::get('logout', 'PhucThinh\Api\Controllers\User@logout');
    });
    Route::middleware('PhucThinh\Api\Middleware\JwtMiddleware')->prefix('user')->group(function () {
        Route::post('change-password', 'PhucThinh\Api\Controllers\User@changePassword');
        Route::post('update-account', 'PhucThinh\Api\Controllers\User@updateAccount');
        Route::post('update-avatar', 'PhucThinh\Api\Controllers\User@updateAvatar');
    });
    Route::prefix('customer')->group(function () {
        Route::get('list', 'PhucThinh\Api\Controllers\Customer@getList');
    });
    Route::middleware('PhucThinh\Api\Middleware\JwtMiddleware')->prefix('factory')->group(function () {
        Route::post('list', 'PhucThinh\Api\Controllers\Factory@getList');
        Route::post('detail', 'PhucThinh\Api\Controllers\Factory@getDetail');
    });
    Route::middleware('PhucThinh\Api\Middleware\JwtMiddleware')->prefix('sensor')->group(function () {
        Route::post('list', 'PhucThinh\Api\Controllers\Device@getListSenSor');
		Route::post('list-name', 'PhucThinh\Api\Controllers\Device@getListNameSenSor');
        Route::post('update-set-point', 'PhucThinh\Api\Controllers\Device@updateSetPoint');
    });
    Route::middleware('PhucThinh\Api\Middleware\JwtMiddleware')->prefix('motor')->group(function () {
        Route::post('list', 'PhucThinh\Api\Controllers\Device@getListMotor');
		Route::post('list-name', 'PhucThinh\Api\Controllers\Device@getListNameMotor');
    });
    Route::middleware('PhucThinh\Api\Middleware\JwtMiddleware')->prefix('valve')->group(function () {
        Route::post('list', 'PhucThinh\Api\Controllers\Device@getListValve');
		Route::post('list-name', 'PhucThinh\Api\Controllers\Device@getListNameValve');
    });
    Route::middleware('PhucThinh\Api\Middleware\JwtMiddleware')->prefix('statistic')->group(function () {
        Route::post('electrical', 'PhucThinh\Api\Controllers\StatisticElectrical@getListElectrical');
        Route::post('chemical', 'PhucThinh\Api\Controllers\StatisticChemical@getListChemical');
        Route::post('flowmeter', 'PhucThinh\Api\Controllers\StatisticFlowmeter@getListFlowmeter');
    });
    
    Route::middleware('PhucThinh\Api\Middleware\JwtMiddleware')->prefix('report')->group(function () {
        Route::post('electrical', 'PhucThinh\Api\Controllers\Report@getListElectrical');
        Route::post('chemical', 'PhucThinh\Api\Controllers\Report@getListChemical');
        Route::post('flowmeter', 'PhucThinh\Api\Controllers\Report@getListFlowmeter');
        
        Route::post('motor', 'PhucThinh\Api\Controllers\Report@getListMotor');
        Route::post('valve', 'PhucThinh\Api\Controllers\Report@getListValve');
        Route::post('sensor', 'PhucThinh\Api\Controllers\Report@getListSensor');
    });
});
