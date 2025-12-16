@extends('layouts.app')

@section('content')
<h4 class="fw-bold mb-3">Add Student Grade</h4>

<form method="POST" action="/teacher/grades">
@csrf

<div class="mb-2">
    <label>Student</label>
    <select name="student_id" class="form-control" required>
        @foreach($students as $student)
        <option value="{{ $student->id }}">{{ $student->id }}</option>
        @endforeach
    </select>
</div>

<div class="mb-2">
    <label>Subject</label>
    <select name="subject_id" class="form-control" required>
        @foreach($subjects as $subject)
        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-2">
    <label>Quiz (30%)</label>
    <input type="number" name="quiz" class="form-control" required>
</div>

<div class="mb-2">
    <label>Project (30%)</label>
    <input type="number" name="project" class="form-control" required>
</div>

<div class="mb-3">
    <label>Exam (40%)</label>
    <input type="number" name="exam" class="form-control" required>
</div>

<button class="btn btn-success">Save Grade</button>

</form>
@endsection
