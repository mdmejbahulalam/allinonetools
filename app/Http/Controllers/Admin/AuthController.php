<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::where('email', $validated['email'])->first();

        if ($admin && Hash::check($validated['password'], $admin->password) && $admin->is_active) {
            auth('admin')->login($admin, $request->boolean('remember'));
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials or account inactive.'])->onlyInput('email');
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }
}
