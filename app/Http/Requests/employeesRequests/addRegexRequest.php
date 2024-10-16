<?php

namespace App\Http\Requests\employeesRequests;

use Illuminate\Foundation\Http\FormRequest;

class addRegexRequest extends FormRequest
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
        'country'=>['required','unique:regexs,country'],
        'regex'=>['required','unique:regexs,regex'],
        ];
    }
}
