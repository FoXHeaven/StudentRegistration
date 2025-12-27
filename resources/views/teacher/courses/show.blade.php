<x-app-layout>
    <x-slot name="header">
        Course Details - {{ $course->course_name }}
    </x-slot>

    <div class="p-6">
        <!-- 返回按钮 -->
        <div class="mb-4">
            <a href="{{ route('teacher.courses.index') }}" 
               class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                &larr; Back to Courses
            </a>
        </div>

        <!-- 课程基本信息 -->
        <div class="mb-6 p-4 border rounded bg-white shadow-sm">
            <h2 class="text-xl font-bold mb-2">{{ $course->course_name }} ({{ $course->course_code }})</h2>
            <p><strong>Capacity:</strong> {{ $course->capacity }}</p>
            <p><strong>Status:</strong> {{ $course->is_open ? 'Open' : 'Closed' }}</p>
            @if($course->description)
                <p class="mt-2"><strong>Description:</strong> {{ $course->description }}</p>
            @endif
            @if($course->file_path)
                <p class="mt-2">
                    <strong>Course File:</strong>
                    <a href="{{ asset('storage/'.$course->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                        View / Download
                    </a>
                </p>
            @endif
        </div>

        <!-- 学生名单 -->
        <div class="p-4 border rounded bg-white shadow-sm">
            <h3 class="text-lg font-bold mb-2">Enrolled Students ({{ $course->students->count() }})</h3>

            @if($course->students->count() > 0)
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Joined At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course->students as $student)
                            <tr>
                                <td class="border px-4 py-2">{{ $student->name }}</td>
                                <td class="border px-4 py-2">{{ $student->email }}</td>
                                <td class="border px-4 py-2">{{ $student->pivot->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No students have enrolled in this course yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>
