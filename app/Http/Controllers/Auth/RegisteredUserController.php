<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 🔍 Get email domain
        $email = $request->email;
        $domain = substr(strrchr($email, "@"), 1);

        // 🎯 Domain → Role mapping
        $roles = [
            'student.com'   => 'student',
            'teacher.com'   => 'teacher',
            'admin.com'     => 'admin',
            'registrar.com' => 'registrar',
        ];

        if (!array_key_exists($domain, $roles)) {
            return back()->withErrors([
                'email' => 'Email domain not authorized',
            ]);
        }

        $role = $roles[$domain];

        // ✅ Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        Auth::login($user);

        // 🔀 Redirect by role
        if ($role === 'student') {
            return redirect('/my-grades');
        }

        if ($role === 'teacher') {
            return redirect('/grades');
        }

        if ($role === 'admin') {
            return redirect('/grades');
        }

        if ($role === 'registrar') {
            return redirect('/dashboard');
        }

        return redirect('/login');
    }
}
