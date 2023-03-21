<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateModulePostRequest;
use Domains\Catalog\Models\Skill;
use Domains\Module\Actions\CreateNewModule;
use Domains\Module\DTOs\NewModuleDTO;
use Domains\Module\Models\Module;
use Domains\Module\Models\TagType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ModulesController extends Controller
{
    public function index(Request $request): Factory|View|Application
    {
        $modules = Module::query()
            ->when($request->filled('search'), function (Builder $builder) use ($request) {
                $search = $request->query('search');

                $builder->when(filter_var($search, FILTER_VALIDATE_INT), function (Builder $builder) use ($search) {
                    $builder->where('id', $search);
                });

                $builder
                    ->orWhere('title', 'like', "%$search%")
                    ->orWhereHas('skill', function (Builder $builder) use ($search) {
                        $builder->where('title', 'like', "%$search%");
                    })
                    ->orWhereHas('user.bio', function (Builder $builder) use ($search) {
                        $builder->where('name', 'like', "%$search%");
                    });
            })
            ->with([
                'skill',
                'user.bio',
                'tags'
            ])
            ->paginate(10)
            ->withQueryString();

        $pages = (int)ceil($modules->total() / $modules->perPage());

        return view('domains.admin.modules.index', compact('modules', 'pages'));
    }

    public function create(): Factory|View|Application
    {
        $skills = Skill::all();

        $tagTypes = TagType::query()
            ->with('tags')
            ->get();

        return view('domains.admin.modules.create', compact('skills', 'tagTypes'));
    }

    public function createPost(CreateModulePostRequest $request, CreateNewModule $action): RedirectResponse
    {
        $action(NewModuleDTO::fromRequest($request));

        flash()->info('Модуль успешно создан!');

        return redirect()->route('admin.modules');
    }

    public function delete(Module $module): RedirectResponse
    {
        $module->delete();

        flash()->info('Модуль удален');

        return redirect()->route('admin.modules');
    }
}
