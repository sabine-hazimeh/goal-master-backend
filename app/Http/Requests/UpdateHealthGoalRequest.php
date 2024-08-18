<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHealthGoalRequest extends FormRequest
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
            'age' => 'sometimes|integer|min:1|max:100',
            'gender' => 'sometimes|in:male,female',
            'height' => 'sometimes|numeric|min:0|max:300',
            'current_weight' => 'sometimes|numeric|min:0|max:200',
            'desired_weight' => 'sometimes|numeric|min:0|max:100',
            'medical_conditions' => 'sometimes|string',
            'time_horizon' => 'sometimes|date',
        ];
    }
}
