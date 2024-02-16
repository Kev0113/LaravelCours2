<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpinionsPostRequest;
use App\Models\Event;
use App\Models\Opinion;
use Illuminate\Http\Request;

class OpinionsController extends Controller
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
    public function create(OpinionsPostRequest $request, $eventId)
    {
        $user = $request->user();

        $setOpinion = new Opinion();
        $setOpinion->text = $request->input('opinion');
        $setOpinion->rate = $request->input('rate');
        $setOpinion->user()->associate($user);
        $setOpinion->event()->associate(Event::findOrFail($eventId));
        $setOpinion->save();
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
