<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chats=Chat::all();
        return response()->json(["chats" => $chats],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatRequest $request)
    {
        $chat = Chat::create($request->validated());
        return response()->json(["chat" => $chat], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatRequest $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
