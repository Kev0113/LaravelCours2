<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class EventsController extends Controller
{
    public function index(){
        $getEvent = Event::all();
        $storagePath = Storage::disk('public')->url('');
        return Inertia::render('Evenement', [
           'events' => $getEvent,
            'storagePath' => $storagePath
        ]);
    }

    public function getEvent(Event $event){
        $event->load('category');
        $event->load('user');
        $event->comments->load('user');
        return Inertia::render('OneEvent', ['event' => $event, 'comments' => $event->comments]);
    }
}
