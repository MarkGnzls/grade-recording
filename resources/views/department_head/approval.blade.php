@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Pending Grade Approvals</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Teacher</th>
                <th>Final Grade</th>
                <th>Status</th>
                <th width="220">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($grades as $grade)
                <tr>
                    <td>{{ $grade->student->name }}</td>
                    <td>{{ $grade->subject->name }}</td>
                    <td>{{ $grade->teacher->name }}</td>
                    <td>{{ $grade->final_grade }}</td>
                    <td>
                        <span class="badge bg-warning">
                            {{ ucfirst($grade->status) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('dept.approve', $grade->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>

                        <button class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#revision{{ $grade->id }}">
                            Request Revision
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="revision{{ $grade->id }}">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('dept.revision', $grade->id) }}">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Revision Comment</h5>
                                        </div>
                                        <div class="modal-body">
                                            <textarea name="comment" class="form-control" required></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No pending grades</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
