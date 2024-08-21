<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJournalsRequest extends FormRequest
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
            'mood' => 'required|string|max:255',
            'productivity' => 'required|integer|min:1|max:10', 
            'focus' => 'required|integer|min:1|max:10', 
            'description' => 'required|string|max:1000', 
            
        ];
        
    }
}
