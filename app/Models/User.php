<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Course;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * 可批量赋值的字段
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * 隐藏字段
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * 类型转换
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // -------------------------
    // 教师关系
    // -------------------------

    /**
     * 教师创建的课程（1对多）
     * 可直接用于 TeacherCourseController
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    /**
     * 教师课程别名，兼容控制器里 teacherCourses() 调用
     */
    public function teacherCourses()
    {
        return $this->courses();
    }

    // -------------------------
    // 学生关系
    // -------------------------

    /**
     * 学生加入的课程（多对多）
     */
    public function studentCourses()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'user_id', 'course_id')
                    ->withTimestamps();
    }
}
