<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // 学生可加入的课程列表 + 搜索功能
    public function index(Request $request)
    {
        $student = Auth::user();

        // 搜索课程
        if ($request->filled('search')) {
            $search = $request->input('search');
            $course = Course::where('course_code', $search)->first();

            if ($course) {
                return redirect()->route('student.courses.show', $course->id);
            } else {
                return redirect()->route('student.courses.index')->with('message', 'Course not found.');
            }
        }

        $courses = Course::whereDoesntHave('students', function ($q) use ($student) {
            $q->where('user_id', $student->id);
        })->get();

        return view('student.courses.index', compact('courses'));
    }

    // 查看单个课程详情
    public function show(Course $course)
    {
        $student = Auth::user();
        $enrolled = $course->students()->where('user_id', $student->id)->exists();

        return view('student.courses.show', compact('course', 'enrolled'));
    }

    // 学生加入课程
    public function enroll(Course $course)
    {
        $student = Auth::user();

        if ($course->students()->where('user_id', $student->id)->exists()) {
            return redirect()->back()->with('message', 'You are already enrolled in this course.');
        }

        $course->students()->attach($student->id);

        return redirect()->route('student.courses.index')->with('success', 'Successfully enrolled in course!');
    }

    // 查看已报名课程
    public function enrolled()
    {
        $student = Auth::user();
        $courses = $student->studentCourses()->get();

        return view('student.courses.enrolled', compact('courses'));
    }
}
