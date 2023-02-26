<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPostRequest;
use App\Http\Requests\RegisterPostRequest;
use Domains\Auth\Actions\RegisterNewUserAction;
use Domains\Auth\DTOs\NewUserBioDTO;
use Domains\Auth\DTOs\NewUserDTO;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(): Factory|View|Application
    {
        return view('domains.auth.login');
    }

    public function loginPost(LoginPostRequest $request): RedirectResponse
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            flash()->error('Ошибка! Неверные данные');

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        flash()->info('Успешная авторизация');
        return redirect()->route('home');
    }

    public function register(): Factory|View|Application
    {
        return view('domains.auth.register');
    }

    public function registerPost(RegisterPostRequest $request, RegisterNewUserAction $action): RedirectResponse
    {
        $user = $action(NewUserDTO::fromRequest($request), NewUserBioDTO::fromRequest($request));

        event(new Registered($user));

        flash()->info('Успешная регистрация');

        return redirect()->route('login');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        flash()->info('Вы вышли из системы');

        return redirect()->route('home');
    }
}
