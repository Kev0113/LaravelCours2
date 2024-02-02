<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $nextEvents = Event::where('starting_date', '>', date('Y-m-d'))->orderBy('starting_date', 'asc')->limit(5)->get();

        $popularCategories = Category::with('events')->with('events.users')->limit(3)->get();

        $storagePath = Storage::disk('public')->url('');

        return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'storagePath' => $storagePath,
        'nextEvents' => $nextEvents,
        'popularCategories' => $popularCategories
    ]);
    }
}
