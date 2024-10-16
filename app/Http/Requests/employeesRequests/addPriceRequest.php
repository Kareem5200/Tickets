<?php

namespace App\Http\Requests\employeesRequests;

use Illuminate\Foundation\Http\FormRequest;

class addPriceRequest extends FormRequest
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
            'stadium_id'=>['required'],
            'station_id'=>['required'],
            'trip_price'=>['required','numeric','min:1','digits_between:2,4'],
            'seat_price'=>['required','numeric','min:1','digits_between:2,4'],



        ];
    }
}
