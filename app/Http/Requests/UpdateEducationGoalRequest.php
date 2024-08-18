<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationGoalRequest extends FormRequest
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
            'goal' => 'sometimes|string|max:255',
            'current_knowledge' => 'sometimes|string|max:255',
            'available_days' => 'sometimes|integer|min:1|max:7', 
            'available_hours' => 'sometimes|integer|min:1|max:24',
            'time_horizon' => 'sometimes|date',
        ];
    }
}
