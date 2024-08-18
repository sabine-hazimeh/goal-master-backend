<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthGoal extends Model
{
    use HasFactory;
    protected $fillable = [
        'age',
        'gender',
        'height',
        'current_weight',
        'desired_weight',
        'time_horizon',
        'medical_conditions',
        'goal_id',
    ];
}
