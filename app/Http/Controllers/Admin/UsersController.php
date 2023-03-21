<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserPostRequest;
use Domains\Auth\Actions\RegisterNewUserAction;
use Domains\Auth\DTOs\NewUserBioDTO;
use Domains\Auth\DTOs\NewUserDTO;
use Domains\Shared\Models\Role;
use Domains\Shared\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->filled('search'), function (Builder $builder) use ($request) {
                $search = $request->query('search');

                $builder->when(filter_var($search, FILTER_VALIDATE_INT), function (Builder $builder) use ($search) {
                    $builder->where('id', $search);
                });

                $builder
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhereHas('bio', function (Builder $builder) use ($search) {
                        $builder
                            ->where('name', 'like', "%$search%")
                            ->orWhere('institution', 'like', "%$search%");
                    });
            })
            ->with('bio')
            ->paginate(10)
            ->withQueryString();

        $pages = (int)ceil($users->total() / $users->perPage());

        return view('domains.admin.users.index', compact('users', 'pages'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('domains.admin.users.create', compact('roles'));
    }

    public function createPost(CreateUserPostRequest $request, RegisterNewUserAction $action)
    {
        $user = $action(NewUserDTO::fromRequest($request), NewUserBioDTO::fromRequest($request));

        event(new Registered($user));

        flash()->info('Пользователь успешно создан');

        return redirect()->route('admin.users');
    }

    public function activatePost(User $user) {
        $user->update([
            'activated_at' => now()
        ]);

        flash()->info('Пользователь активирован');

        return redirect()->route('admin.users');
    }

    public function delete(User $user) {
        $user->delete();

        flash()->info('Пользователь удален');

        return redirect()->route('admin.users');
    }
}
