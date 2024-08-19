<?php

namespace App\Http\Controllers;

use App\Models\message;
use App\Http\Requests\StoremessageRequest;
use App\Http\Requests\UpdatemessageRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $message = Message::all(); 
        return response()->json(["message" => $message], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremessageRequest $request)
    {
        $message = Message::create($request->validated());
        return response()->json(["message" => $message], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemessageRequest $request, message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(message $message)
    {
        //
    }
}
