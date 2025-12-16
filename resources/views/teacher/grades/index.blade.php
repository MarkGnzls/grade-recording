@extends('layouts.app')

@section('content')
<div class="container">
    <h4>My Grades</h4>

    <a href="{{ route('teacher.grades.create') }}" class="btn btn-primary mb-3">
        Add Grade
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Quiz</th>
                <th>Project</th>
                <th>Exam</th>
                <th>Final</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($grades as $grade)
            <tr>
                <td>{{ $grade->student->name }}</td>
                <td>{{ $grade->subject->name }}</td>
                <td>{{ $grade->quiz }}</td>
                <td>{{ $grade->project }}</td>
                <td>{{ $grade->exam }}</td>
                <td>{{ $grade->final_grade }}</td>
                <td>{{ ucfirst($grade->status) }}</td>
                <td>
                    @if($grade->status === 'draft')
                        <form method="POST" action="{{ route('teacher.grades.submit', $grade) }}">
                            @csrf
                            <button class="btn btn-success btn-sm">
                                Submit
                            </button>
                        </form>
                    @else
                        <span class="text-muted">Locked</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
