<?php
declare(strict_types=1);

namespace Domains\Auth\Actions;

use Domains\Auth\DTOs\NewUserBioDTO;
use Domains\Auth\DTOs\NewUserDTO;
use Domains\Shared\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class RegisterNewUserAction
{
    public function __invoke(NewUserDTO $newUserDTO, NewUserBioDTO $newUserBioDTO): User
    {
        DB::beginTransaction();

        $user = User::query()->create([
            'email' => $newUserDTO->email,
            'password' => Hash::make($newUserDTO->password),
            'role_id' => $newUserDTO->role_id
        ]);

        $user->bio()->create([
            'name' => $newUserBioDTO->name,
            'sex' => $newUserBioDTO->sex,
            'city' => $newUserBioDTO->city,
            'institution' => $newUserBioDTO->institution,
            'institution_type' => $newUserBioDTO->institution_type
        ]);

        DB::commit();

        return $user;
    }
}
