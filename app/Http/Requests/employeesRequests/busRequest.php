<?php

namespace App\Http\Requests\employeesRequests;

use Illuminate\Foundation\Http\FormRequest;

class busRequest extends FormRequest
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
            'seats'=>['required','numeric','digits:2','min:14','max:90'],
            'bus_number'=>['required','string','min:7','max:15','regex:/^[\p{Arabic}]{2,4}-[0-9]{2,4}$/u'],
        ];
    }
}
