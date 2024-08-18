<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationGoal extends Model
{
    use HasFactory;
    protected $fillable = [
        'goal',
        'current_knowledge',
        'available_days',
        'available_hours',
        'time_horizon',
        'goal_id',
    ];
    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

}
