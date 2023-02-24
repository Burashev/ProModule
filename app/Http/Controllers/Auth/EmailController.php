<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class EmailController extends Controller
{
    public function verify(): Factory|View|Application
    {
        return view('domains.auth.email.verify');
    }

    public function verifyHandler(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return redirect()->route('home');
    }

    public function sendVerificationPost(): RedirectResponse
    {
        auth()->user()->sendEmailVerificationNotification();

        return redirect()->route('home');
    }
}
