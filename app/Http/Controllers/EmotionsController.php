<?php

namespace App\Http\Controllers;

use App\Models\Emotions;
use App\Http\Requests\StoreEmotionsRequest;
use App\Http\Requests\UpdateEmotionsRequest;

class EmotionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emotions = Emotions::all();
        return response()->json(["emotions" => $emotions], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmotionsRequest $request)
    {
        $emotions = Emotions::create($request->validated());
        return response()->json(["emotions" => $emotions], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Emotions $emotions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emotions $emotions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmotionsRequest $request, Emotions $emotions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emotions $emotions)
    {
        //
    }
}
