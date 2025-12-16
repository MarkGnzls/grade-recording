@extends('layouts.app')

@section('content')
<h2 class="mb-4">Dashboard</h2>

<div class="row g-3">

    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6>Total Grades</h6>
                <h2>{{ $totalGrades }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-secondary text-white">
            <div class="card-body">
                <h6>Draft</h6>
                <h2>{{ $draftGrades }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning">
            <div class="card-body">
                <h6>Submitted</h6>
                <h2>{{ $submittedGrades }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6>Approved</h6>
                <h2>{{ $approvedGrades }}</h2>
            </div>
        </div>
    </div>

</div>

<hr class="my-4">

<p>
    Logged in as:
    <strong>{{ auth()->user()->name }}</strong>
    ({{ auth()->user()->role }})
</p>
@endsection
