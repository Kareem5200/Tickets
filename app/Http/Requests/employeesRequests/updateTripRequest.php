<?php

namespace App\Http\Requests\employeesRequests;

use Illuminate\Foundation\Http\FormRequest;

class updateTripRequest extends FormRequest
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
            'driver_id'=>['required'],
            'stadium_id'=>['required'],
            'station_id'=>['required'],
            'bus_id'=>['required'],
            'travel_time'=>['required'],
            'trip_date'=>['required','date'],
        ];
    }
}
