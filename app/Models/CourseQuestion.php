<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseQuestion extends Model
{
    use HasFactory , SoftDeletes, HasUlids;

    protected $guarded = ['id'];

    // relasi dengan course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // relasi dengan answers
    public function answers()
    {
        return $this->hasMany(CourseAnswer::class, 'course_question_id', 'id');
    }

}
