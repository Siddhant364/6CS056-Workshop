<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration
    |--------------------------------------------------------------------------
    */

    // Display registration form
    public function showRegister(): View
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Create new user
        $user = User::create($validated);

        // Automatically log in the registered user
        Auth::login($user);

        // Regenerate session
        $request->session()->regenerate();

        return redirect('/courses');
    }

    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    // Display login form
    public function showLogin(): View
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request): RedirectResponse
    {
        // Validate login information
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {

            // Regenerate session after successful login
            $request->session()->regenerate();

            return redirect()->intended('/courses');
        }

        // Return error if credentials are incorrect
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle user logout
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
