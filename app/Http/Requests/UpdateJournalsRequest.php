<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJournalsRequest extends FormRequest
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
            'mood' => 'sometimes|string|max:255',
            'productivity' => 'sometimes|integer|min:1|max:10', 
            'focus' => 'sometimes|integer|min:1|max:10', 
            'description' => 'sometimes|string|max:1000', 
            'emotion_id' => 'sometimes|exists:emotions,id'
        ];
    }
}
