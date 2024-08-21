<?php

namespace App\Http\Controllers;

use App\Models\Journals;
use App\Models\Emotions;
use App\Http\Requests\StoreJournalsRequest;
use App\Http\Requests\UpdateJournalsRequest;

class JournalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $journals = Journals::all();
        return response()->json(["journals" => $journals], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJournalsRequest $request)
    {
       
        $validatedData = $request->validated();
        $emotionData = $request->validate([
            'emotion' => 'required|string|max:255',
        ]);
        $emotion = Emotions::create([
            'type' => 'manual',
            'emotion' => $emotionData['emotion'],
        ]);
        $validatedData['emotion_id'] = $emotion->id;
        $validatedData['user_id'] = auth()->id();
        $journal = Journals::create($validatedData);

        return response()->json(['journal' => $journal, 'emotion' => $emotion], 201);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJournalsRequest $request, Journals $journal)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();
        $journal->update($validatedData);

        return response()->json(["journals" => $journal], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Journals $journals)
    {
        $journals->delete();
        return response()->json(["message" => "Journals deleted successfully"], 200);
    }

public function userJournals()
{
    $userId = auth()->id(); 
    $journals = Journals::with('emotion')->where('user_id', $userId)->get();
    return response()->json(['journals' => $journals], 200);
}

}
