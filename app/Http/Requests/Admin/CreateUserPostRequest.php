<?php

namespace App\Http\Requests\Admin;

use Domains\Shared\Enums\RolesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role_id->isAdministrator();
    }

    public function rules(): array
    {
        $competitorId = RolesEnum::COMPETITOR_ID->value;
        $adminId = RolesEnum::ADMINISTRATOR_ID->value;

        return [
            'email' => ['email:dns', 'required', 'unique:users,email'],
            'name' => ['required'],
            'sex' => ['required'],
            'city' => ['required'],
            'institution' => ['required'],
            'institution_type' => ['required'],
            'password' => ['required', Password::default()],
            'role_id' => ['required', 'integer', "between:{$competitorId},{$adminId}"]
        ];
    }
}
