<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    use HasFactory;
    protected $fillable=[
        'sender_id',
        'chat_id',
        'content',
    ];
    public function chat(){
        return $this->belongsTo(Chat::class);
    }
    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
}
