@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Audit Logs</h3>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Record Affected</th>
                <th>Date & Time</th>
            </tr>
        </thead>

        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{ $log->user->name }}</td>
                    <td>{{ $log->action }}</td>
                    <td>
                        {{ $log->grade_id ? 'Grade #' . $log->grade_id : '-' }}
                    </td>
                    <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No logs found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
