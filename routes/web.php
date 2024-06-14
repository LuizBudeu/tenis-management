<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TennisCourtController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

// Home
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Navigation
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Tennis
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/tennis-courts', [TennisCourtController::class, 'indexInertia'])->name('tennisCourts.indexInertia');
    Route::get('/tennis-courts/control', [TennisCourtController::class, 'controlInertia'])->name('tennisCourts.controlInertia');
});

Route::get('/setup', function () {
    $credentials = [
        'name' => config('auth.admin_name'),
        'email' => config('auth.admin_email'),
        'password' => config('auth.admin_password'),
    ];

    if (!Auth::attempt($credentials)) {
        $user = new \App\Models\User();
        $user->name = config('auth.admin_name');
        $user->email = config('auth.admin_email');
        $user->password = bcrypt(config('auth.admin_password'));
        $user->save();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $adminToken = $user->createToken('admin');
            $basicToken = $user->createToken('basic', ['read']);

            return [
                'admin' => $adminToken->plainTextToken,
                'basic' => $basicToken->plainTextToken
            ];
        }
    }
});

Route::get('/zero', function () {
    User::find(2)->delete();
});

require __DIR__.'/auth.php';
