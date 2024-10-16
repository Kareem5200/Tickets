<?php

namespace App\Http\Requests\employeesRequests;

use App\Rules\ProfileImageValidator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class registerRequest extends FormRequest
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
            'name'=>['required','string','max:255'],
            'email'=>['required','email','unique:employees,email','max:255'],
            'password'=>['required','confirmed',Password::min(8)->mixedCase()->numbers()->symbols()],
            'secret_key'=>['required','string'],
            'ssn'=>['required','digits:14','numeric','regex:/^([2-3]{1})([0-9]{2})(0[1-9]|1[012])(0[1-9]|[1-2][0-9]|3[0-1])(0[1-4]|[1-2][1-9]|3[1-5]|88)[0-9]{3}([0-9]{1})[0-9]{1}$/'],
            'gender'=>['required'],
            'profile_picture'=>['required','image','mimes:jpeg,png,jpg,gif','max:2048',new ProfileImageValidator],
        ];
    }
}
