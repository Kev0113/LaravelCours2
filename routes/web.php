<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class);

Route::get('/event', function (){
    return Inertia::render('Evenement', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('event');


Route::prefix('/event')->group(function(){
    Route::get('/', [\App\Http\Controllers\EventsController::class, 'index'])->name('event');
    Route::get('/{event}', [EventsController::class, 'getEvent'])->name('getEvent');
    Route::post('/participate', [EventsController::class, 'participate'])->name('participate');
    Route::post('/filter', [FilterController::class, 'index'])->name('filter');
});

Route::prefix('/comments')->group(function (){
   Route::post('/create/{x}', [CommentsController::class, 'create'])->name('addComment');
});

//Route::prefix('/filter')->group(function(){
//   Route::post('/name', [FilterController::class, 'index'])->name('filter');
//});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

