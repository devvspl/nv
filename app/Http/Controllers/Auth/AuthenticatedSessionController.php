<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        if ($request->has('redirect')) {
            session(['url.intended' => $request->input('redirect')]);
        }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if ($request->has('redirect')) {
            session(['url.intended' => $request->input('redirect')]);
        }

        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        // Clear generic /dashboard, /login, or /register intended URLs
        $intended = session('url.intended');
        if ($intended && (str_contains($intended, '/dashboard') || str_contains($intended, '/login') || str_contains($intended, '/register'))) {
            session()->forget('url.intended');
        }

        return redirect()->intended($user->getDashboardUrl());
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
        } catch (\Exception $e) {
            // Log the error but don't prevent logout
            \Log::error('Logout error: ' . $e->getMessage());
        }

        // Always redirect to login regardless of any errors
        return redirect()->route('login');
    }
}
