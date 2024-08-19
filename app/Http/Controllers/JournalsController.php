<?php

namespace App\Http\Controllers;

use App\Models\Journals;
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
        $journals = Journals::create($request->validated());
        return response()->json(["journals" => $journals], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Journals $journal)
    {
        return response()->json(["journals" => $journal], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJournalsRequest $request, Journals $journal)
    {
       $journal->update($request->validated());
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
}
