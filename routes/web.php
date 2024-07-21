<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\HomeController;

// Auth Routes
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register-form');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('login', [AuthController::class, 'loginForm'])->name('login-form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Events Organizer Routes
Route::middleware(['auth', 'check.event.role:1'])->group(function () {
	Route::get('events/attendees', [AttendeeController::class, 'index'])->name('attendees.index');
	Route::get('events/dashboard', [AttendeeController::class, 'dashboard'])->name('organizer.dashboard');

	Route::resource('ticket-types', TicketTypeController::class);
});

// Event Attendee Routes
Route::middleware(['auth', 'check.event.role:2'])->group(function () {
	Route::get('events/tickets/{event}/purchase', [TicketController::class, 'showPurchaseForm'])->name('tickets.purchase');
	Route::post('events/tickets/{event}/create-payment-intent', [TicketController::class, 'createPaymentIntent'])->name('tickets.createPaymentIntent');
	Route::post('events/tickets/{event}/purchase', [TicketController::class, 'purchaseTicket'])->name('tickets.purchase');
});

// Common Routes
Route::middleware(['auth'])->group(function () {
	Route::get('/', [HomeController::class, 'homepage'])->name('homepage');
	Route::post('events/{id}/comment', [EventController::class, 'comment'])->name('events.comment');

	Route::resource('events', EventController::class);
});
