@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Reports & GPA</h3>

    {{-- FILTERS --}}
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-3">
            <select name="subject_id" class="form-control">
                <option value="">All Subjects</option>
                @foreach($subjects as $s)
                    <option value="{{ $s->id }}" {{ request('subject_id')==$s->id?'selected':'' }}>
                        {{ $s->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="teacher_id" class="form-control">
                <option value="">All Teachers</option>
                @foreach($teachers as $t)
                    <option value="{{ $t->id }}" {{ request('teacher_id')==$t->id?'selected':'' }}>
                        {{ $t->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <input type="number" name="min_grade" class="form-control"
                   placeholder="Min Grade" value="{{ request('min_grade') }}">
        </div>

        <div class="col-md-2">
            <input type="number" name="max_grade" class="form-control"
                   placeholder="Max Grade" value="{{ request('max_grade') }}">
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">Apply</button>
        </div>
    </form>

    {{-- GPA --}}
    @if($gpa !== null)
        <div class="alert alert-info">
            <strong>Computed GPA:</strong> {{ $gpa }}
        </div>
    @endif

    {{-- CHART --}}
    <div class="card mb-4">
        <div class="card-body">
            <canvas id="gradeChart"></canvas>
        </div>
    </div>

    {{-- TABLE --}}
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Teacher</th>
                <th>Final Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $g)
                <tr>
                    <td>{{ $g->student->name }}</td>
                    <td>{{ $g->subject->name }}</td>
                    <td>{{ $g->teacher->name }}</td>
                    <td>{{ $g->final_grade }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('gradeChart');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($distribution)) !!},
        datasets: [{
            label: 'Grade Distribution',
            data: {!! json_encode(array_values($distribution)) !!}
        }]
    }
});
</script>
@endsection
