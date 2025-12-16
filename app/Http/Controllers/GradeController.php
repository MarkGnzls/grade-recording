<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    /**
     * Show all grades (Teacher view)
     */
    public function index()
    {
        $grades = Grade::with(['student', 'subject', 'teacher'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('grades.index', compact('grades'));
    }

    /**
     * Show create grade form
     */
    public function create()
    {
        return view('grades.create', [
            'students' => Student::all(),
            'subjects' => Subject::all(),
        ]);
    }

    /**
     * Store a new grade
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'quiz'       => 'required|numeric',
            'project'    => 'required|numeric',
            'exam'       => 'required|numeric',
        ]);

        $finalGrade = (
            $request->quiz +
            $request->project +
            $request->exam
        ) / 3;

        Grade::create([
            'student_id'  => $request->student_id,
            'subject_id'  => $request->subject_id,
            'teacher_id'  => Auth::id(), // ✅ FIXED
            'quiz'        => $request->quiz,
            'project'     => $request->project,
            'exam'        => $request->exam,
            'final_grade' => round($finalGrade),
            'status'      => 'draft',
        ]);

        return redirect('/grades')->with('success', 'Grade saved');
    }

    /**
     * Update grade (only if NOT locked)
     */
    public function update(Request $request, Grade $grade)
    {
        if ($grade->status === 'locked') {
            return back()->with('error', 'Grade is locked');
        }

        $finalGrade = (
            $request->quiz +
            $request->project +
            $request->exam
        ) / 3;

        $grade->update([
            'quiz'        => $request->quiz,
            'project'     => $request->project,
            'exam'        => $request->exam,
            'final_grade' => round($finalGrade),
        ]);

        return back()->with('success', 'Grade updated');
    }

    /**
     * Submit grade (draft → submitted)
     */
    public function submit(Grade $grade)
    {
        if ($grade->status !== 'draft') {
            return back()->with('error', 'Only draft grades can be submitted');
        }

        $grade->update(['status' => 'submitted']);

        return back()->with('success', 'Grade submitted');
    }

    /**
     * Approve grade (submitted → approved)
     */
    public function approve(Grade $grade)
    {
        if ($grade->status !== 'submitted') {
            return back()->with('error', 'Only submitted grades can be approved');
        }

        $grade->update(['status' => 'approved']);

        return back()->with('success', 'Grade approved');
    }

    /**
     * Lock grade (approved → locked)
     */
    public function lock(Grade $grade)
    {
        if ($grade->status !== 'approved') {
            return back()->with('error', 'Only approved grades can be locked');
        }

        $grade->update(['status' => 'locked']);

        return back()->with('success', 'Grade locked');
    }
}
