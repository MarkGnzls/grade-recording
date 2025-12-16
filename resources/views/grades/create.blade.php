@extends('app')

@section('content')

<h3 class="mb-3">Add Grade</h3>

<form method="POST" action="/grades">
    @csrf

    {{-- Student --}}
    <div class="mb-3">
        <label class="form-label">Student</label>
        <select name="student_id" class="form-control" required>
            <option value="">-- Select Student --</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}">
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Subject --}}
    <div class="mb-3">
        <label class="form-label">Subject</label>
        <select name="subject_id" class="form-control" required>
            <option value="">-- Select Subject --</option>
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}">
                    {{ $subject->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Quiz --}}
    <div class="mb-3">
        <label class="form-label">Quiz</label>
        <input type="number" name="quiz" class="form-control" required>
    </div>

    {{-- Project --}}
    <div class="mb-3">
        <label class="form-label">Project</label>
        <input type="number" name="project" class="form-control" required>
    </div>

    {{-- Exam --}}
    <div class="mb-3">
        <label class="form-label">Exam</label>
        <input type="number" name="exam" class="form-control" required>
    </div>

    <button class="btn btn-success">Save Grade</button>
    <a href="/grades" class="btn btn-secondary">Cancel</a>
</form>

@endsection
