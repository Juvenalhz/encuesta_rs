<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedesSocialesController;
use App\Http\Controllers\EncuestaController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(RedesSocialesController::class)->group(function () {
Route::get('/redesSociales', 'index');
});

Route::controller(EncuestaController::class)->group(function () {
    Route::post('/encuesta', 'store');
    Route::get('/promedioRedesSociales', 'avgRedesSociales');
    Route::get('/conteoRedes', 'countRedesSociales');
    Route::get('/edadesRedes', 'edadesRedesSociales');
    });