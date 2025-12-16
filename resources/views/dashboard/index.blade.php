@extends('layouts.app')

@section('content')

<h3 class="fw-bold mb-1">Dashboard</h3>
<p class="text-muted mb-4">
    Overview of the Grade Recording Workflow
</p>

<div class="row g-3">

    <div class="col-md-2">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <small class="text-muted">Subjects</small>
                <h3 class="fw-bold">{{ $subjects }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <small class="text-muted">Draft</small>
                <h3 class="fw-bold text-secondary">{{ $draft }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <small class="text-muted">Submitted</small>
                <h3 class="fw-bold text-warning">{{ $submitted }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <small class="text-muted">Approved</small>
                <h3 class="fw-bold text-success">{{ $approved }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <small class="text-muted">Locked</small>
                <h3 class="fw-bold text-danger">{{ $locked }}</h3>
            </div>
        </div>
    </div>

</div>

<div class="card mt-4 shadow-sm">
    <div class="card-body">
        <h5 class="fw-semibold">System Status</h5>
        <p class="text-muted mb-0">
            Grades follow a controlled workflow from draft entry, submission,
            approval by the department head, and final locking by the registrar.
        </p>
    </div>
</div>

@endsection
