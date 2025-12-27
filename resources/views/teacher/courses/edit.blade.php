<x-app-layout>
    <x-slot name="header">Edit Course</x-slot>

    <form method="POST" action="{{ route('teacher.courses.update', $course) }}" class="p-6">
        @csrf @method('PUT')

        <input name="course_code" value="{{ $course->course_code }}"><br><br>
        <input name="course_name" value="{{ $course->course_name }}"><br><br>
        <textarea name="description">{{ $course->description }}</textarea><br><br>
        <input type="number" name="capacity" value="{{ $course->capacity }}"><br><br>

        <button>Update</button>
    </form>
</x-app-layout>
