<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function goal(){
        return $this->hasOne(FinanceGoal::class);
    }
}
