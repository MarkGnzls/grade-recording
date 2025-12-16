@extends('layouts.app')

@section('content')

<h4 class="fw-bold mb-3">Edit Grade</h4>

<form method="POST" action="{{ route('teacher.grades.update', $grade->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label class="form-label">Student</label>
        <select name="student_id" class="form-control" required>
            @foreach($students as $student)
                <option value="{{ $student->id }}"
                    {{ $grade->student_id == $student->id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-2">
        <label class="form-label">Subject</label>
        <select name="subject_id" class="form-control" required>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}"
                    {{ $grade->subject_id == $subject->id ? 'selected' : '' }}>
                    {{ $subject->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-2">
        <label class="form-label">Quiz (30%)</label>
        <input type="number" name="quiz" class="form-control"
               value="{{ $grade->quiz }}" min="0" max="100" required>
    </div>

    <div class="mb-2">
        <label class="form-label">Project (30%)</label>
        <input type="number" name="project" class="form-control"
               value="{{ $grade->project }}" min="0" max="100" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Exam (40%)</label>
        <input type="number" name="exam" class="form-control"
               value="{{ $grade->exam }}" min="0" max="100" required>
    </div>

    <button class="btn btn-primary">Update Grade</button>
    <a href="{{ route('teacher.grades') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
