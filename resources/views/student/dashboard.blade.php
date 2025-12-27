<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Student Dashboard</h2>
    </x-slot>

    <div class="p-4 bg-white shadow rounded d-flex flex-column gap-3">
        <h3>Welcome, {{ auth()->user()->name }}!</h3>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('student.courses.index') }}" class="btn btn-dark">View Available Courses</a>
            <a href="{{ route('student.courses.enrolled') }}" class="btn btn-outline-dark">View Enrolled Courses</a>
        </div>
    </div>
</x-app-layout>
