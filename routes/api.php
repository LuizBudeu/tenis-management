<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TennisCourtController;


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('tennis-courts', TennisCourtController::class);
});

// Route::apiResource('tennis-courts', TennisCourtController::class);


