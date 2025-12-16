@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Registrar Panel</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('registrar.export') }}" class="btn btn-primary mb-3">
        Export CSV
    </a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Teacher</th>
                <th>Final Grade</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($grades as $grade)
                <tr>
                    <td>{{ $grade->student->name }}</td>
                    <td>{{ $grade->subject->name }}</td>
                    <td>{{ $grade->teacher->name }}</td>
                    <td>{{ $grade->final_grade }}</td>
                    <td>
                        @if($grade->locked)
                            <span class="badge bg-danger">Locked</span>
                        @else
                            <span class="badge bg-success">Approved</span>
                        @endif
                    </td>
                    <td>
                        @if(!$grade->locked)
                            <form method="POST" action="{{ route('registrar.lock', $grade->id) }}">
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    Lock Grade
                                </button>
                            </form>
                        @else
                            <em>Locked</em>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
