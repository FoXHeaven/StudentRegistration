<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Course;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ✅ 老师创建的课程（1对多）
    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    // ✅ 学生加入的课程（多对多）
    public function studentCourses()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'user_id', 'course_id')
                    ->withTimestamps();
    }
}
