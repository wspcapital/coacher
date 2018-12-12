<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'location_city' => 'required|Regex:/^[a-zA-Z\.\s-]+$/',
            'company' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|end_date:start_date',
            'part' => 'numeric'
        ];
    }
}
