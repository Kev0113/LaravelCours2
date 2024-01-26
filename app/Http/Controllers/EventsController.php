<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $get_category = Category::findOrFail($event->category_id);
        return Inertia::render('OneEvent', ['event' => $event, 'category' => $get_category ]);
    }
}
