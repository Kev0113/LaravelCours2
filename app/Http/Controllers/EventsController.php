<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventsController extends Controller
{
    public function index(){
        $getEvent = Event::all();
        return Inertia::render('Evenement', [
           'events' => $getEvent
        ]);
    }

    public function getEvent($eventId){
        $event = Event::findOrFail($eventId);
        return Inertia::render('OneEvent', [
                'event' => $event
        ]);
    }
}
