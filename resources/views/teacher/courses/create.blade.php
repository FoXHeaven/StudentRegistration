<x-app-layout>
    <x-slot name="header"><h2>Create Course</h2></x-slot>

    <form action="{{ route('teacher.courses.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow rounded">
        @csrf
        <div class="mb-3">
            <label class="form-label">Course Code</label>
            <input type="text" name="course_code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" name="course_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">File (optional)</label>
            <input type="file" name="file_path" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" name="capacity" class="form-control" value="30">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_open" value="1" class="form-check-input" checked>
            <label class="form-check-label">Open for enrollment</label>
        </div>
        <button type="submit" class="btn btn-dark">Create Course</button>
    </form>
</x-app-layout>
