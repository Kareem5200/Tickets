<?php

namespace App\Http\Requests\employeesRequests;

use Illuminate\Foundation\Http\FormRequest;

class maintenanceRequest extends FormRequest
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
            // 'bus_id'=>['required','numeric'],
            'maintenance_price'=>['required','numeric','min:0'],
            'maintenance_description'=>['required','string','max:255'],
            'maintenance_date'=>['required','date'],
        ];
    }
}
