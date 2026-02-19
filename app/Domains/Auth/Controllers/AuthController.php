<?php

namespace App\Domains\Auth\Controllers;

use App\Domains\Auth\Actions\LoginUserAction;
use App\Domains\Auth\Actions\RegisterUserAction;
use App\Domains\Auth\Requests\LoginRequest;
use App\Domains\Auth\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        private readonly RegisterUserAction $registerUserAction,
        private readonly LoginUserAction $loginUserAction
    ) {}

    /**
     * Show the login form.
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Handle a login request.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (! $this->loginUserAction->execute([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'remember' => $validated['remember'] ?? false,
        ])) {
            return back()->withErrors([
                'email' => __('auth.failed'),
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = $this->registerUserAction->execute([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    /**
     * Show the dashboard (authenticated users only).
     */
    public function dashboard(): View
    {
        return view('auth.dashboard');
    }

    /**
     * Handle a logout request.
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}
