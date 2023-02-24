<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPostRequest;
use App\Http\Requests\RegisterPostRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(): Factory|View|Application
    {
        return view('domains.auth.login');
    }

    public function loginPost(LoginPostRequest $request): RedirectResponse
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function register(): Factory|View|Application
    {
        return view('domains.auth.register');
    }

    public function registerPost(RegisterPostRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $user = User::query()->create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id
            ]);

            $user->bio()->create($request->only([
                'name',
                'sex',
                'city',
                'institution',
                'institution_type',
            ]));

            event(new Registered($user));
        });

        return redirect()->route('login');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->route('home');
    }
}
