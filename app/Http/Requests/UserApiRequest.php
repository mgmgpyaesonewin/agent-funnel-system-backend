<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserApiRequest extends FormRequest
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
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'utm_source' => 'nullable',
            'utm_medium' => 'nullable',
            'utm_campaign' => 'nullable',
            'utm_term' => 'nullable',
        ];
    }
}
