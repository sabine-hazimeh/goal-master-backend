<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journals extends Model
{
    use HasFactory;
    protected $fillable = ['mood', 'productivity', 'focus', 'description', 'emotion_id', 'user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    
   

}
