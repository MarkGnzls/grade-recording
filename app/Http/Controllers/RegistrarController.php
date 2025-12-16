<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Helpers\AuditHelper;

AuditHelper::log('Locked grade', $grade->id);
AuditHelper::log('Exported grades');
class RegistrarController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'subject', 'teacher'])
            ->where('status', 'approved')
            ->get();

        return view('registrar.index', compact('grades'));
    }

    public function lock(Grade $grade)
    {
        if ($grade->locked) {
            return back()->with('error', 'Grade already locked.');
        }

        $grade->update([
            'locked' => true,
            'locked_at' => now(),
            'locked_by' => Auth::id(),
            'status' => 'locked'
        ]);

        return back()->with('success', 'Grade locked successfully.');
    }

    public function export(): StreamedResponse
    {
        $grades = Grade::with(['student', 'subject', 'teacher'])
            ->where('locked', true)
            ->get();

        return response()->streamDownload(function () use ($grades) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'Student',
                'Subject',
                'Teacher',
                'Final Grade',
                'Locked At'
            ]);

            foreach ($grades as $grade) {
                fputcsv($handle, [
                    $grade->student->name,
                    $grade->subject->name,
                    $grade->teacher->name,
                    $grade->final_grade,
                    $grade->locked_at
                ]);
            }

            fclose($handle);
        }, 'final_grades.csv');
    }
}
