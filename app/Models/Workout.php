<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exercise;

class Workout extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'exercise_id', 'repetitions', 'weight', 'break_time', 'day', 'observations', 'time'];
    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id');
    }
}
