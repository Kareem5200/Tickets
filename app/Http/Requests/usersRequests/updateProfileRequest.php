<?php

namespace App\Http\Requests\usersRequests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class updateProfileRequest extends FormRequest
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

            'phone_1'=>['required', 'numeric','digits:11',Rule::unique('users')->ignore($this->user),'regex:/^01[0125][0-9]{8}$/'],
        ];
    }
}
