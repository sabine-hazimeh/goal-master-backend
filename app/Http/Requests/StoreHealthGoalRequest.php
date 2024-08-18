<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHealthGoalRequest extends FormRequest
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
        'age' => 'required|integer|min:1|max:100',
        'gender' => 'required|in:male,female',
        'height' => 'required|numeric|min:0|max:300',
        'current_weight' => 'required|numeric|min:0|max:200',
        'desired_weight' => 'required|numeric|min:0|max:100',
        'medical_conditions' => 'required|string',
        'time_horizon' => 'required|date',
        'goal_id' => 'required|exists:goals,id',
        ];
    }
}
