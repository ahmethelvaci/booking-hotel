<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'reservation_id' => ['required', 'integer'],
            'credit_card_owner_name' => ['required', 'string', 'min:3', 'max:255'],
            'credit_card_number' => ['required', 'regex:/^[0-9]{16}$/'],
            'credit_card_month' => ['required', 'numeric', 'min:1', 'max:12'],
            'credit_card_year' => ['required', 'numeric', 'min:2024', 'max:2054'],
            'credit_card_cvc' => ['required', 'numeric', 'digits:3'],
        ];
    }
}
