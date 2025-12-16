<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AuditHelper;
AuditHelper::log('Approved grade', $grade->id);
AuditHelper::log('Requested revision', $grade->id);

class DepartmentHeadController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'subject', 'teacher'])
            ->where('status', 'submitted')
            ->get();

        return view('department_head.approvals', compact('grades'));
    }

    public function approve(Grade $grade)
    {
        $grade->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Grade approved successfully.');
    }

    public function requestRevision(Request $request, Grade $grade)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        $grade->update([
            'status' => 'draft',
        ]);

        // OPTIONAL: save comment in audit_logs table
        // AuditLog::create([...]);

        return back()->with('success', 'Revision requested.');
    }
}
