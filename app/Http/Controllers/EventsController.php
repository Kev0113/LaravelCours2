<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventToUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class EventsController extends Controller
{
    public function index(){
        $getEvent = Event::all();
        $storagePath = Storage::disk('public')->url('');
        return Inertia::render('Evenement', [
           'events' => $getEvent,
            'storagePath' => $storagePath,
        ]);
    }

    public function getEvent(Event $event){
        $get_category = Category::findOrFail($event->category_id);
        return Inertia::render('OneEvent', ['event' => $event, 'category' => $get_category ]);
    }

    public function participate(Request $request){
        $validation = Validator::make($request->all(), [
            'eventId' => 'required|numeric|exists:events,id'
        ]);

        if ($validation->validated()){
            $user = $request->user();

            if ($user->events->contains($request->input('eventId'))){
                return redirect()->back()->with('error', 'Vous êtes déjà insrit(e) pour cet événement');
            }

            $user->events()->attach($request->input('eventId'));

            return redirect()->back()->with('success', 'Votre participation a bien été prise en compte');

        }
    }
}
