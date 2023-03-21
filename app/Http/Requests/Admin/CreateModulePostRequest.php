<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateModulePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role_id->isAdministrator();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'skill_id' => 'required|exists:skills,id',
            'task_file' => "required|file|max:10000|mimes:docx,doc",
            'media_files' => 'required|array',
            'media_files.*' => 'file|max:10000|mimes:zip,rar',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'time' => 'required|integer|min:0'
        ];
    }
}
