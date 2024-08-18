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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'age' => 'required|integer',
            'gender' => 'required|string',
            'height' => 'required|integer',
            'current_weight' => 'required|integer',
            'desired_weight' => 'required|integer',
            'medical_conditions' => 'required|string',
            'time_horizon' => 'required|date',
        ];
    }
}
