@extends('layouts.app')

@section('content')

<h3>Grades</h3>

<a href="/grades/create" class="btn btn-success mb-3">Add Grade</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Student</th>
            <th>Subject</th>
            <th>Teacher</th>
            <th>Quiz</th>
            <th>Project</th>
            <th>Exam</th>
            <th>Final</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($grades as $grade)
        <tr>
            <td>{{ $grade->id }}</td>
            <td>{{ $grade->student->name }}</td>
            <td>{{ $grade->subject->name }}</td>
            <td>{{ $grade->teacher->name }}</td>
            <td>{{ $grade->quiz }}</td>
            <td>{{ $grade->project }}</td>
            <td>{{ $grade->exam }}</td>
            <td><strong>{{ $grade->final_grade }}</strong></td>
            <td>{{ ucfirst($grade->status) }}</td>
            <td>
                @if($grade->status === 'draft')
                    <form method="POST" action="/grades/{{ $grade->id }}/submit">
                        @csrf
                        <button class="btn btn-primary btn-sm">Submit</button>
                    </form>
                @elseif($grade->status === 'submitted' && auth()->user()->role === 'admin')
                    <form method="POST" action="/grades/{{ $grade->id }}/approve">
                        @csrf
                        <button class="btn btn-warning btn-sm">Approve</button>
                    </form>
                @elseif($grade->status === 'approved' && auth()->user()->role === 'admin')
                    <form method="POST" action="/grades/{{ $grade->id }}/lock">
                        @csrf
                        <button class="btn btn-danger btn-sm">Lock</button>
                    </form>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="10" class="text-center">No grades found</td>
        </tr>
    @endforelse
    </tbody>
</table>

@endsection

                {{-- ADMIN: Lock --}}
                @if(auth()->user()->role === 'admin' && $grade->status === 'approved')
                    <form method="POST" action="/grades/{{ $grade->id }}/lock" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm">
                            Lock
                        </button>
                    </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center">
                No grades found
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
