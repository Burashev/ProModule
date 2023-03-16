<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Domains\Module\Models\Module;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class ModuleController extends Controller
{
    public function index(Module $module): Factory|View|Application|RedirectResponse
    {
        if (Gate::denies('show', $module)) {
            flash()->info('У вас нет доступа к данному модулю');

            return redirect()->route('catalog');
        }

        $fileLink = $module->file->link;

        $module->load([
            'user.bio',
            'mediaFiles'
        ]);

        return view('domains.module.index', compact('module', 'fileLink'));
    }
}
