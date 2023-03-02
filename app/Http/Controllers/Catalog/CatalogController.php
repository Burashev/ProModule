<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Domains\Catalog\Models\Module;

class CatalogController extends Controller
{
    public function index()
    {
        $modules = Module::query()
            ->with([
                'skill',
                'user.bio',
            ])
            ->filtered()
            ->paginate(10)
            ->withQueryString();

        $pages = (int)ceil($modules->total() / $modules->perPage());

        return view('domains.catalog.index', compact('modules', 'pages'));
    }
}
