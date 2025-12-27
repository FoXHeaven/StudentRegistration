<x-app-layout>
    <x-slot name="header"><h2>Available Courses</h2></x-slot>

    <form method="GET" action="{{ route('student.courses.index') }}" class="mb-3 d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Enter subject code">
        <button type="submit" class="btn btn-dark">Search</button>
    </form>

    <div class="row g-3">
        @foreach($courses as $course)
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->course_name }}</h5>
                    <p class="card-text">Code: {{ $course->course_code }}</p>
                    <div class="d-flex gap-2">
                        <form action="{{ route('student.courses.enroll', $course->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-dark btn-sm">Enroll</button>
                        </form>
                        <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-outline-dark btn-sm">View</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
