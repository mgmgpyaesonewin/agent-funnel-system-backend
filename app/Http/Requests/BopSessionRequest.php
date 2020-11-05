<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BopSessionRequest extends FormRequest
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
            'date' => 'required|date',
            'time' => 'required',
            'url' => 'required|active_url',
            'enable' => 'integer'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Title',
            'date' => 'Date',
            'time' => 'Time',
            'url' => 'URL',
        ];
    }
}
