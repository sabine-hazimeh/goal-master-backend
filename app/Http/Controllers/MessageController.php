<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoremessageRequest;
use App\Http\Requests\UpdatemessageRequest;
use Illuminate\Http\Request;


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
        $validatedData = $request->validated();
        $validatedData['sender_id'] = auth()->id();
        $message = Message::create($validatedData);
        return response()->json(["message" => $message], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(message $message)
    {
       return response()->json(["message" => $message], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemessageRequest $request, message $message)
    {
        $validatedData = $request->validated();
        $validatedData['sender_id'] = auth()->id();
        $message->update($validatedData);
        return response()->json(["message" => $message], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(message $message)
    {
        $message->delete();
        return response()->json(["message" => "Message deleted successfully"], 200);
    }
    public function getMessagesByChatId($chat_id)
    {
        $messages = Message::where('chat_id', $chat_id)->get();
        return response()->json(["messages" => $messages], 200);
    }
}
