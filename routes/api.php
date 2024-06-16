<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


Route::post('/usuarios', [ApiController::class, 'registerUser']);
Route::post('/viajes', [ApiController::class, 'createTravel']);