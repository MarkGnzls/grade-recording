@extends('layouts.app')

@section('content')

<h4 class="fw-bold mb-3">Grade Approvals</h4>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-bordered table-hover mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>Quiz</th>
                    <th>Project</th>
                    <th>Exam</th>
                    <th>Final</th>
                    <th width="200">Actions</th>
                </tr>
            </thead>

            <tbody class="text-center">
                @forelse($grades as $grade)
                <tr>
                    <td>{{ $grade->student->name }}</td>
                    <td>{{ $grade->subject->name }}</td>
                    <td>{{ $grade->teacher->name }}</td>
                    <td>{{ $grade->quiz }}</td>
                    <td>{{ $grade->project }}</td>
                    <td>{{ $grade->exam }}</td>
                    <td class="fw-bold">{{ $grade->final_grade }}</td>

                    <td>
                        {{-- APPROVE --}}
                        <form method="POST"
                              action="{{ route('dept.approvals.approve', $grade->id) }}"
                              class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">
                                Approve
                            </button>
                        </form>

                        {{-- REQUEST REVISION --}}
                        <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#revise{{ $grade->id }}">
                            Revise
                        </button>

                        {{-- MODAL --}}
                        <div class="modal fade" id="revise{{ $grade->id }}">
                            <div class="modal-dialog">
                                <form method="POST"
                                      action="{{ route('dept.approvals.revise', $grade->id) }}">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Revision Comment</h5>
                                        </div>
                                        <div class="modal-body">
                                            <textarea name="revision_note"
                                                      class="form-control"
                                                      rows="4"
                                                      required
                                                      placeholder="State reason for revision..."></textarea>
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
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-3">
                        No grades pending approval.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection
