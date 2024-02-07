<?php

namespace App\Http\Controllers;

use App\Http\Requests\FiltersPostRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FiltersPostRequest $request)
    {
        $getEvent = Event::where(function ($query) use ($request) {
            $query->where('title', 'LIKE', "%" . $request->input('filterName') . "%")
                ->orWhere('content', 'LIKE', "%" . $request->input('filterName') . "%")
                ->orWhere('tags', 'LIKE', "%" . $request->input('filterName') . "%");
            })
            ->whereBetween('price', [$request->input('minPrice'), $request->input('maxPrice')])
            ->orderBy('price', $request->input('orderBy'))
            ->get();



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
