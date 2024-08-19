<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emotions extends Model
{
    use HasFactory;
    protected $fillable = ["emotion","type"];
    public function journal()
    {
        return $this->belongsTo(Journal::class, 'emotion_id');
    }
}
