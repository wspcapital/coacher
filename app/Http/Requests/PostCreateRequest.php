<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
            'alias' => 'required|regex:/^[a-z0-9\-]{3,255}/',
/*            'title' => 'regex:/^[a-z0-9\s]{3,255}/',
            'subtitle' => 'regex:/^[a-z0-9\s]{3,255}/',*/
            'category_id' => 'required',
        ];
    }
}
