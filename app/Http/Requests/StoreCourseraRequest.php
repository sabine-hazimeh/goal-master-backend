<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseraRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'hours' => 'required|integer|min:1',
            'level' => 'required|in:Beginner level,Intermediate level,Advanced level',
            'url' => 'required|url|max:255',
            'education_id' => 'required|exists:education_goals,id',
        ];
    }
}
