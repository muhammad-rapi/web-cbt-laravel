<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseAnswer extends Model
{
    use HasFactory, SoftDeletes, HasUlids;

    protected $guarded = ['id'];
 
    // relasi dengan course question
    public function question()
    {
        return $this->belongsTo(CourseQuestion::class, 'question_id');
    }
}
