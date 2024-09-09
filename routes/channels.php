<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    
    return true;
});


