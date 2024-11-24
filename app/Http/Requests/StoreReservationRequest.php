<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'hotel_id' => ['required', 'integer'],
            'room_id' => ['required', 'integer'],
            'number_of_people' => ['required', 'numeric', 'min:1', 'max:4'],
            'start_date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:start_date'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'surname' => ['required', 'string', 'min:3', 'max:255'],
            'date_of_birth' => ['required', 'date', 'date_format:Y-m-d'],
            'phone_number' => ['required', 'regex:/^0[0-9]{10}$/'],
            'address' => ['required', 'string', 'min:3', 'max:1024'],
            'tax_no' => ['required', 'numeric', 'max_digits:12'],
            'tax_office' => ['nullable', 'string', 'min:3', 'max:255'],
            'booking_people' => ['required', 'array', 'min:1', 'max:4'],
            'booking_people.*.name' => ['required', 'string', 'min:3', 'max:255'],
            'booking_people.*.surname' => ['required', 'string', 'min:3', 'max:255'],
            'booking_people.*.date_of_birth' => ['required', 'date', 'date_format:Y-m-d'],
            'booking_people.*.phone_number' => ['nullable', 'regex:/^0[0-9]{10}$/'],
        ];
    }
}
