<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParticipant extends FormRequest
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
            'id' => 'required',
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'id_number' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'This field is required',
            'name.required' => 'This field is required',
            'lastname.required' => 'This field is required',
            'email.required' => 'This field is required',
            'email.email' => 'This is a wrong email address',
            'id_number.required' => 'This field is required',

        ];
    }
}
