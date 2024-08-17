<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceGoal extends Model
{
    use HasFactory;
    protected $fillable = [
        'income',
        'savings',
        'expenses',
        'target',
        'target_date',
        'goal_id',
    ];
    public function goal(){
        return $this->belongsTo(Goal::class);
    }
}
