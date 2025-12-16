<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AuditHelper;

class TeacherGradeController extends Controller
{
    /**
     * Display teacher grades
     */
    public function index()
    {
        $grades = Grade::with(['student', 'subject'])
            ->where('teacher_id', Auth::id())
            ->get();

        return view('teacher.grades.index', compact('grades'));
    }

    /**
     * Show create grade form
     */
    public function create()
    {
        return view('teacher.grades.create', [
            'students' => Student::all(),
            'subjects' => Subject::all(),
        ]);
    }

    /**
     * Store grade (DRAFT)
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'subject_id' => 'required',
            'quiz' => 'required|numeric',
            'project' => 'required|numeric',
            'exam' => 'required|numeric',
        ]);

        // ✅ Automatic final grade computation
        $final = ($request->quiz * 0.3)
               + ($request->project * 0.3)
               + ($request->exam * 0.4);

        $grade = Grade::create([
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => Auth::id(),
            'quiz' => $request->quiz,
            'project' => $request->project,
            'exam' => $request->exam,
            'final_grade' => $final,
            'status' => 'draft',
        ]);

        // ✅ Audit log AFTER grade exists
        AuditHelper::log('Created grade (draft)', $grade->id);

        return redirect()->route('teacher.grades');
    }

    /**
     * Submit grade for approval
     */
    public function submit($id)
    {
        $grade = Grade::where('teacher_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $grade->update([
            'status' => 'submitted'
        ]);

        // ✅ Audit log AFTER update
        AuditHelper::log('Submitted grade for approval', $grade->id);

        return redirect()->route('teacher.grades');
    }
}
