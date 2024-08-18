<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationGoalRequest extends FormRequest
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
            'goal' => 'required|string|max:255',
            'current_knowledge' => 'required|string|max:255',
            'available_days' => 'required|integer|min:1|max:7', 
            'available_hours' => 'required|integer|min:1|max:24',
            'time_horizon' => 'required|date',
        ];
    }
    
}
