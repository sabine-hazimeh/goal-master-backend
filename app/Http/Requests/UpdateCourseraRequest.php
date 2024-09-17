<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseraRequest extends FormRequest
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
          'title' => 'sometimes|string|max:255',
            'hours' => 'sometimes|integer|min:1',
            'level' => 'sometimes|in:Beginner level,Intermediate level,Advanced level',
            'url' => 'sometimes|url|max:255',
            'education_id' => 'sometimes|exists:education_goals,id',
        ];
    }
}
