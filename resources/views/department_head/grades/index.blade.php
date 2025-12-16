@extends('layouts.app')

@section('content')

<h4 class="fw-bold mb-3">Submitted Grades for Review</h4>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Student</th>
            <th>Subject</th>
            <th>Quiz</th>
            <th>Project</th>
            <th>Exam</th>
            <th>Final Grade</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($grades as $grade)
        <tr>
            <td>{{ $grade->student_id }}</td>
            <td>{{ $grade->subject_id }}</td>
            <td>{{ $grade->quiz }}</td>
            <td>{{ $grade->project }}</td>
            <td>{{ $grade->exam }}</td>
            <td>{{ $grade->final_grade }}</td>
            <td class="d-flex gap-2">

                <!-- APPROVE -->
                <form method="POST" action="{{ route('dept.grades.approve', $grade->id) }}">
                    @csrf
                    <button class="btn btn-success btn-sm">
                        Approve
                    </button>
                </form>

                <!-- REQUEST REVISION -->
                <button class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#revise{{ $grade->id }}">
                    Request Revision
                </button>

                <!-- MODAL -->
                <div class="modal fade" id="revise{{ $grade->id }}">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('dept.grades.revise', $grade->id) }}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Revision Reason</h5>
                                </div>
                                <div class="modal-body">
                                    <textarea name="revision_note"
                                              class="form-control"
                                              required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary"
                                            data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button class="btn btn-warning">
                                        Send Revision
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
