<x-app-layout>
    <x-slot name="header">
        <h2>My Enrolled Courses</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded space-y-4">
        @if($courses->isEmpty())
            <p>You have not enrolled in any courses yet.</p>
        @else
            <ul class="space-y-2">
                @foreach($courses as $course)
                    <li class="border p-4 rounded flex justify-between items-center">
                        <div>
                            <strong>{{ $course->course_code }}</strong> - {{ $course->course_name }}
                        </div>
                        <a href="{{ route('student.courses.show', $course->id) }}"
                           class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                           View
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
