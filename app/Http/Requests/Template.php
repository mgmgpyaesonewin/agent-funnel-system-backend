<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Template extends FormRequest
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
            'template_name'=> 'required',
            'name'=> 'nullable|boolean',
            'nrc' =>  'nullable|boolean',
            'nrc_photo'=>  'nullable|boolean',
            'contact_no' =>  'nullable|boolean',
            'alternate_no'=> 'nullable|boolean',
            'preferred_name'=> 'nullable|boolean',
            'dob'=> 'nullable|boolean',
            'gender'=> 'nullable|boolean',
            'myanmar_citizen'=> 'nullable|boolean',
            'citizenship'=> 'nullable|boolean',
            'race'=> 'nullable|boolean',
            'marital_status'=> 'nullable|boolean',
            'address'=> 'nullable|boolean',
            'city'=> 'nullable|boolean',
            'township'=> 'nullable|boolean',
            'highest_qualification'=> 'nullable|boolean',
            'email'=> 'nullable|boolean',
            'conflict_interest'=> 'nullable|boolean',
            'term_condition'=> 'nullable|boolean',
        ];
    }
}
