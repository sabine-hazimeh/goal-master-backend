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
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();
        $chat = Chat::create($validatedData);
        return response()->json(["chat" => $chat], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        return response()->json(["chat" => $chat],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatRequest $request, Chat $chat)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();
        $chat->update($validatedData);
        return response()->json(["chat" => $chat], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        $chat->delete();
        return response()->json(["message" => "Chat deleted successfully"], 200);
    }
     /**
     * Get or create a chat between the authenticated user and the consultant.
     */
    public function getOrCreateChat(Request $request)
    {
        $consultant_id = $request->consultant_id;
        $user_id = auth()->id();
        $chat = Chat::where(function ($query) use ($consultant_id, $user_id) {
            $query->where('consultant_id', $consultant_id)
                ->where('user_id', $user_id);
        })->orWhere(function ($query) use ($consultant_id, $user_id) {
            $query->where('consultant_id', $user_id)
                ->where('user_id', $consultant_id);
        })->first();

        if (!$chat) {
            $chat = Chat::create([
                'consultant_id' => $consultant_id,
                'user_id' => $user_id,
            ]);
        }

        return response()->json(["chat" => $chat], 200);
    }
    /**
     * Display the messages of a chat.
     */
    public function getMessages($chat_id)
    {
        $messages = message::where('chat_id', $chat_id)->get();
        return response()->json(["messages" => $messages], 200);
    }

}