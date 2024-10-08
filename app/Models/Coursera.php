<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursera extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
        'hours',
        'level',
        'url',
        'education_id',
    ];
    

    public function education()
    {
        return $this->belongsTo(EducationGoal::class);
    }
}
