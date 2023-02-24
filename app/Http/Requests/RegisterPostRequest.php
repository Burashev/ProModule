<?php

namespace App\Http\Requests;

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
        return [
            'email' => ['email:dns', 'required'],
            'name' => ['required'],
            'sex' => ['required'],
            'city' => ['required'],
            'institution' => ['required'],
            'institution_type' => ['required'],
            'password' => ['required', 'confirmed', Password::default()],
            'role_id' => ['required', 'integer', 'digits_between:1,2']
        ];
    }
}
