<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Teacher Dashboard</h2>
    </x-slot>

    <div class="p-4 bg-white shadow rounded d-flex flex-column gap-3">
        <h3>Welcome, {{ auth()->user()->name }}!</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('teacher.courses.index') }}" class="btn btn-dark">Manage My Courses</a>
            <a href="{{ route('teacher.courses.create') }}" class="btn btn-outline-dark">Create New Course</a>
        </div>
    </div>
</x-app-layout>
