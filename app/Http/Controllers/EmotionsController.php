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
    public function show(Emotions $emotion)
    {
        return response()->json(["emotions" => $emotion], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmotionsRequest $request, Emotions $emotion)
    {
       $emotion->update($request->validated());
       return response()->json(["emotions" => $emotion], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emotions $emotion)
    {
        $emotion->delete();
        return response()->json(["message" => "Emotion deleted successfully"], 200);
    }
}
