<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyEventsController;
use App\Http\Controllers\OpinionsController;
use App\Http\Controllers\ParticipantsController;
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
    Route::get('/{event}', [EventsController::class, 'show'])->name('getEvent');
    Route::post('/participate', [ParticipantsController::class, 'create'])->name('participate');
    Route::post('/filter', [FilterController::class, 'index'])->name('filter');
    Route::get('/delete/{event}', [EventsController::class, 'destroy'])->name('deleteEvent');
});

Route::prefix('/comments')->group(function (){
   Route::post('/create/{x}', [CommentsController::class, 'create'])->name('addComment');
});

Route::prefix('/opinions')->group(function(){
   Route::post('/create/{x}', [OpinionsController::class, 'create'])->name('addOpinion');
});

Route::prefix('/my-events')->group(function (){
    Route::get('/', [MyEventsController::class, 'index'])->name('myEvents');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

