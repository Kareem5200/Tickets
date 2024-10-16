<?php

namespace App\Http\Requests\usersRequests;

use Illuminate\Foundation\Http\FormRequest;

class addDependentRequest extends FormRequest
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
            'name'=>['required','max:255'],
            'ssn'=>['required','numeric','digits:14','unique:dependents,ssn','regex:/^([2-3]{1})([0-9]{2})(0[1-9]|1[012])(0[1-9]|[1-2][0-9]|3[0-1])(0[1-4]|[1-2][1-9]|3[1-5]|88)[0-9]{3}([0-9]{1})[0-9]{1}$/'],
            'gender'=>['required'],
            // 'birth_date'=>['required','date'],
            'personal_image'=>['required','image','mimes:jpeg,png,jpg,gif','max:2048'],
            'birth_certificate'=>['required','image','mimes:jpeg,png,jpg,gif','max:2048']

        ];
    }
}
