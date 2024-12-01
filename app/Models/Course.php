<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory,SoftDeletes, HasUlids;

    protected $guarded = ['id'];

    // relasi dengan kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // relasi dengan course question
    public function questions()
    {
        return $this->hasMany(CourseQuestion::class, 'course_id', 'id');
    }

    // relasi dengan course
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_students', 'course_id', 'user_id');
    }
}
