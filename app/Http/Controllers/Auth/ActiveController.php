<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ActiveController extends Controller
{
    public function __invoke(): Factory|View|Application
    {
        return view('domains.auth.active.active');
    }
}
