@extends('layouts.app')

@section('content')

<h3 class="mb-3">My Grades</h3>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Subject</th>
            <th>Teacher</th>
            <th>Quiz</th>
            <th>Project</th>
            <th>Exam</th>
            <th>Final Grade</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($grades as $grade)
        <tr>
            <td>{{ $grade->id }}</td>
            <td>{{ $grade->subject->name }}</td>
            <td>{{ $grade->teacher->name }}</td>
            <td>{{ $grade->quiz }}</td>
            <td>{{ $grade->project }}</td>
            <td>{{ $grade->exam }}</td>
            <td><strong>{{ $grade->final_grade }}</strong></td>
            <td>
                <span class="badge bg-secondary">
                    {{ ucfirst($grade->status) }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">
                No grades available
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
