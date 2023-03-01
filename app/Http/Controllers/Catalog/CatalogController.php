<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Domains\Catalog\Models\Module;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $modules = Module::query()->with([
            'skill',
            'user.bio',
        ])->get();

        return view('domains.catalog.index', compact('modules'));
    }
}
