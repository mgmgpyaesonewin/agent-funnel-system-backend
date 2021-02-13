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
    public function rules(): array
    {
        return [
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'phone' => 'required|unique:applicants,phone',
            'utm_source' => 'nullable',
            'utm_medium' => 'nullable',
            'utm_campaign' => 'nullable',
            'utm_term' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Applicant Name is required',
            'dob.required' => 'Invalid Date of Birth',
            'gender' => 'Gender is required',
            'phone' => 'Phone number is required',
            'phone.unique' => 'Phone number already exists',
        ];
    }
}
