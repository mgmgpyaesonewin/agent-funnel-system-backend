<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBankInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'account_no' => 'required',
            'name' => 'required',
            'bank_name' => 'required',
            'license_number' => 'required',
            'bank_branch_name' => 'required',
            'license_photo' => 'required|mimes:jpg,jpeg,png'
        ];
    }
}
