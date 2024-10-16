<?php

namespace App\Http\Requests\employeesRequests;

use Illuminate\Foundation\Http\FormRequest;

class competitionRequest extends FormRequest
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
            'comp_name'=>['required','string','max:255'],
            'comp_country'=>['required'],
            'comp_session'=>['required','numeric','digits:4'],
            // 'comp_price'=>['required','numeric','min:0']
        ];
    }
}
