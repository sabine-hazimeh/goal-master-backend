<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFinanceGoalRequest extends FormRequest
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
            "income" => "sometimes|numeric",
            "savings" => "sometimes|numeric",
            "expenses" => "sometimes|numeric",
            "target" => "sometimes|numeric",
            "target_date" => "sometimes|date",
        ];
    }
}
