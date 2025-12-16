<?php

namespace App\Helpers;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditHelper
{
    public static function log(string $action, $gradeId = null): void
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'grade_id' => $gradeId,
        ]);
    }
}
