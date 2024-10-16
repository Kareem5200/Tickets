<?php

namespace App\Http\Requests\employeesRequests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class updateStadiumRequest extends FormRequest
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
            'name'=>['string','max:255',Rule::unique('stadiums')->ignore($this->stadium)],
            // 'capacity'=>['numeric','min:0'],
        ];
    }
}
