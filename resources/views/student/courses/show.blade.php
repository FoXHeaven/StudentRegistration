<x-app-layout>
    <x-slot name="header"><h2>{{ $course->course_name }}</h2></x-slot>

    <div class="bg-white p-4 shadow rounded">
        <p><strong>Course Code:</strong> {{ $course->course_code }}</p>
        <p><strong>Description:</strong> {{ $course->description }}</p>
        <p><strong>Capacity:</strong> {{ $course->capacity }}</p>
        <p><strong>Status:</strong> {{ $course->is_open ? 'Open' : 'Closed' }}</p>

        @if(!$enrolled)
        <form action="{{ route('student.courses.enroll', $course->id) }}" method="POST">
            @csrf
            <button class="btn btn-dark">Enroll</button>
        </form>
        @else
        <span class="badge bg-success">Already Enrolled</span>
        @endif
    </div>
</x-app-layout>
