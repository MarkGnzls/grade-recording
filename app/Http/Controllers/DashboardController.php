<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $teacherId = Auth::id();

        return view('dashboard', [
            'totalGrades' => Grade::where('teacher_id', $teacherId)->count(),
            'draftGrades' => Grade::where('teacher_id', $teacherId)->where('status', 'draft')->count(),
            'submittedGrades' => Grade::where('teacher_id', $teacherId)->where('status', 'submitted')->count(),
            'approvedGrades' => Grade::where('teacher_id', $teacherId)->where('status', 'approved')->count(),
            'lockedGrades' => Grade::where('teacher_id', $teacherId)->where('status', 'locked')->count(),
        ]);
    }
}
