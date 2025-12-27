<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // 显示老师自己的课程
    public function index()
    {
        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('teacher.courses.index', compact('courses'));
    }

    // 显示创建课程页面
    public function create()
    {
        return view('teacher.courses.create');
    }

    // 保存新课程
    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|max:10240',
            'capacity' => 'nullable|integer|min:1',
        ]);

        $filePath = null;
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('course_files', 'public');
        }

        auth()->user()->teacherCourses()->create([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,
            'description' => $request->description,
            'file_path' => $filePath,
            'capacity' => $request->capacity ?? 30,
            'is_open' => $request->has('is_open') ? true : false,
        ]);

        return redirect()->route('teacher.courses.index')->with('success', 'Course created successfully!');
    }

    // 显示编辑课程页面
    public function edit(Course $course)
    {
        return view('teacher.courses.edit', compact('course'));
    }

    // 更新课程
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_code' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|max:10240',
            'capacity' => 'nullable|integer|min:1',
        ]);

        $filePath = $course->file_path;
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('course_files', 'public');
        }

        $course->update([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,
            'description' => $request->description,
            'file_path' => $filePath,
            'capacity' => $request->capacity ?? $course->capacity,
            'is_open' => $request->has('is_open') ? true : false,
        ]);

        return redirect()->route('teacher.courses.index')->with('success', 'Course updated successfully!');
    }

    // 删除课程
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('teacher.courses.index')->with('success', 'Course deleted successfully!');
    }

    // 显示课程详情
    public function show(Course $course)
    {
        return view('teacher.courses.show', compact('course'));
    }
}
