<?php

namespace App\Http\Controllers;

use App\Jobs\SendConfirmMail;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'eventId' => 'required|numeric|exists:events,id'
        ]);

        if ($validation->validated()){
            $user = $request->user();

            if ($user->events->contains($request->input('eventId'))){
                return redirect()->back()->with('error', 'Vous êtes déjà insrit(e) pour cet événement');
            }

            try{

                $user->events()->attach($request->input('eventId'));
                dispatch(new SendConfirmMail(auth()->user(), Event::findOrFail((int) $request->input('eventId'))));

            }catch(Exception $e){
                die($e);

            }




            return redirect()->back()->with('success', 'Votre participation a bien été prise en compte');

        }
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
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
