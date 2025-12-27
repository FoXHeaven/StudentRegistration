<x-app-layout>
    <x-slot name="header"><h2>My Courses</h2></x-slot>

    <div class="row g-3">
        @foreach($courses as $course)
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->course_name }}</h5>
                    <p class="card-text">Code: {{ $course->course_code }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('teacher.courses.show', $course->id) }}" class="btn btn-outline-dark btn-sm">Open</a>
                        <a href="{{ route('teacher.courses.edit', $course->id) }}" class="btn btn-dark btn-sm">Edit</a>
                        <form action="{{ route('teacher.courses.destroy', $course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
