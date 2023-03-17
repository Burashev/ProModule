<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateModulePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'skill_id' => 'required|exists:skills,id',
            'task_file' => "required|file|max:10000|mimes:docx,doc",
            'media_files' => 'required|array',
            'media_files.*' => 'file|max:10000|mimes:zip,rar',
        ];
    }
}
