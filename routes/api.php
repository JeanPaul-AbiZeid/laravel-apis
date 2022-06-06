<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/time', [ApiController::class, 'getTime']);
Route::get('/pal', [ApiController::class, 'countPal']);
Route::get('/nominee', [ApiController::class, 'nominee']);
Route::get('/list', [ApiController::class, 'toList']);
Route::get('/getapi', [ApiController::class, 'getApi']);
