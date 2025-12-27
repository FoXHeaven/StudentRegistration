<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code',
        'course_name',
        'description',
        'file_path',
        'teacher_id',
        'capacity',
        'is_open',
    ];

    // 课程所属老师
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // 课程的学生
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'user_id')
                    ->withTimestamps();
    }
}
