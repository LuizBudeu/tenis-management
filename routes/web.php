<?php

use App\Http\Controllers\TennisCourtController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/tennis-courts');
});

Route::get('/tennis-courts', [TennisCourtController::class, 'indexInertia'])->name('tennisCourts.indexInertia');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/tennis-courts/control', [TennisCourtController::class, 'controlInertia'])->name('tennisCourts.controlInertia');
});

require __DIR__.'/auth.php';
