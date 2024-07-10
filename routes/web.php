<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UrlsController;
use App\Http\Controllers\PlanController;

Route::get('/', function () {
	return view('auth.login');
})->name('login');

// Auth routes
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register-form');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('login', [AuthController::class, 'loginForm'])->name('login-form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // URLs routes
    Route::post('urls/deactivate/{id}', [UrlsController::class, 'deactivate'])->name('deactivate.url');
    Route::resource('urls', UrlsController::class);

    // Plans routes
    Route::get('upgrade-plan', [PlanController::class, 'showUpgradeForm'])->name('upgrade.plan');
    Route::post('upgrade-plan', [PlanController::class, 'upgrade'])->name('upgrade.plan');
});
