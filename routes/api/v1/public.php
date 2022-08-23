<?php
use App\Http\Controllers\V1\Public\ContractorController;
use App\Http\Controllers\V1\Public\LgaController;
use App\Http\Controllers\V1\Public\MdaController;
use App\Http\Controllers\V1\Public\ProjectController;
use App\Http\Controllers\V1\Public\SectorController;
use App\Http\Controllers\V1\Public\StateController;
use Illuminate\Support\Facades\Route;

Route::get('/states', [StateController::class, 'index']);
Route::get('/lgas', [LgaController::class, 'index']);
Route::get('/mdas', [MdaController::class, 'index']);
Route::get('/contractors', [ContractorController::class, 'index']);
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/sectors', [SectorController::class, 'index']);