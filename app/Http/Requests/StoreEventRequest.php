<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    $date = \Carbon\Carbon::parse($value);

                    // Check if the date is in the past
                    if ($date < \Carbon\Carbon::now()) {
                        $fail('The '.$attribute.' must be a date in the future.');
                    }
                },
            ],
            'location' => 'required|string|max:255',
            'ticket_availability' => 'required|integer|min:1'
        ];
    }
}
