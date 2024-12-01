<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentAnswer extends Model
{
    use HasFactory, SoftDeletes, HasUlids;

    protected $guarded = ['id'];

    // relasi dengan student
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // relasi dengan question
    public function questions()
    {
        return $this->belongsTo(CourseQuestion::class, 'course_question_id');
    }
}
