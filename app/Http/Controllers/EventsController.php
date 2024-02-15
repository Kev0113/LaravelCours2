<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getEvent = Event::whereBetween('price', [0, 1000000])
            ->withCount('users')
            ->orderBy('price', 'ASC')
            ->paginate(12);

        $storagePath = Storage::disk('public')->url('');
        return Inertia::render('Evenement', [
            'events' => $getEvent,
            'storagePath' => $storagePath,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('category');
        $event->load('user');
        $event->loadCount('users');
        $event->comments->load('user');
        $event->load('opinion');
        return Inertia::render('OneEvent', ['event' => $event, 'comments' => $event->comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect('/my-events');
    }
}

