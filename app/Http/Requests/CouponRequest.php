<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'type' => 'required|in:discount,free',
            'discount' => 'required_if:type,discount|integer|min:0|max:99',
            'vcoaches' => 'required_if:type,free|integer|min:0|max:99',
            'sessions' => 'required_if:type,free|integer|min:0|max:99',
            'quantity' => 'required|integer|min:1',
        ];
    }
}
