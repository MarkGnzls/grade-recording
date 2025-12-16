<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Grade::with(['student', 'subject', 'teacher'])
            ->whereIn('status', ['approved', 'locked']);

        // Filters
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        if ($request->filled('min_grade')) {
            $query->where('final_grade', '>=', $request->min_grade);
        }

        if ($request->filled('max_grade')) {
            $query->where('final_grade', '<=', $request->max_grade);
        }

        $grades = $query->get();

        /* =========================
           GPA COMPUTATION
        ========================= */
        $gpa = null;
        if ($grades->count() > 0) {
            $points = $grades->map(function ($g) {
                if ($g->final_grade >= 90) return 4.0;
                if ($g->final_grade >= 85) return 3.5;
                if ($g->final_grade >= 80) return 3.0;
                if ($g->final_grade >= 75) return 2.5;
                return 2.0;
            });
            $gpa = round($points->avg(), 2);
        }

        /* =========================
           GRADE DISTRIBUTION
        ========================= */
        $distribution = [
            '90-100' => $grades->whereBetween('final_grade', [90,100])->count(),
            '85-89'  => $grades->whereBetween('final_grade', [85,89])->count(),
            '80-84'  => $grades->whereBetween('final_grade', [80,84])->count(),
            '75-79'  => $grades->whereBetween('final_grade', [75,79])->count(),
            '<75'    => $grades->where('final_grade', '<', 75)->count(),
        ];

        return view('reports.index', [
            'grades'       => $grades,
            'subjects'     => Subject::all(),
            'teachers'     => User::where('role', 'teacher')->get(),
            'gpa'          => $gpa,
            'distribution' => $distribution,
        ]);
    }
}
