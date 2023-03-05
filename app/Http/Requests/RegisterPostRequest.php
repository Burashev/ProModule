<?php

namespace App\Http\Requests;

use Domains\Shared\Enums\RolesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $competitorId = RolesEnum::COMPETITOR_ID->value;
        $expertId = RolesEnum::EXPERT_ID->value;

        return [
            'email' => ['email:dns', 'required', 'unique:users,email'],
            'name' => ['required'],
            'sex' => ['required'],
            'city' => ['required'],
            'institution' => ['required'],
            'institution_type' => ['required'],
            'password' => ['required', 'confirmed', Password::default()],
            'role_id' => ['required', 'integer', "between:{$competitorId},{$expertId}"]
        ];
    }
}
