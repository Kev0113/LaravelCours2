<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsPostRequest;
use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __invoke(){

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CommentsPostRequest $request, $eventId)
    {
        $user = $request->user();

        $setComment = new Comment();
        $setComment->comment = $request->input('message');
        $setComment->user()->associate($user);
        $setComment->event()->associate(Event::findOrFail($eventId));
        $setComment->save();
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
