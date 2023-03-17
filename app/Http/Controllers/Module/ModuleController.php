<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateModulePostRequest;
use Domains\Catalog\Models\Skill;
use Domains\Module\Actions\CreateNewModule;
use Domains\Module\DTOs\NewModuleDTO;
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

    public function create(): Factory|View|Application|RedirectResponse
    {
        $skills = auth()->user()->role_id->isAdministrator() ?
            Skill::all() : auth()->user()->skills;

        return view('domains.module.create', compact('skills'));
    }

    public function createPost(CreateModulePostRequest $request, CreateNewModule $action) {
        $module = $action(NewModuleDTO::fromRequest($request));

        flash()->info('Модуль успешно создан!');

        return redirect()->route('module', $module);
    }
}
