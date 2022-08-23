<?php

use App\Http\Controllers\V1\Admin\AdminAuthController;
use App\Http\Controllers\V1\Admin\ContractorController;
use App\Http\Controllers\V1\Admin\LgaController;
use App\Http\Controllers\V1\Admin\MdaController;
use App\Http\Controllers\V1\Admin\ProjectController;
use App\Http\Controllers\V1\Admin\SectorController;
use App\Http\Controllers\V1\Admin\StateController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/auth'], function(){
    Route::post('/login', [AdminAuthController::class, 'loginAdmin']);
    Route::post('/register', [AdminAuthController::class, 'registerAdmin']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::group(['prefix' => '/general-settings'], function() {
        Route::apiResource('/states', StateController::class);
        Route::apiResource('/lgas', LgaController::class);
        Route::apiResource('/mdas', MdaController::class);
        Route::apiResource('/contractors', ContractorController::class);
        Route::apiResource('/sectors', SectorController::class);
    });

    Route::apiResource('/projects', ProjectController::class);
});