<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParticipant extends FormRequest
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
            'lastname' => 'required',
            'email' => 'required|unique:participants|email',
            'type' => 'required',
            'id_number' => 'required|unique:participants'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'This field is required',
            'lastname.required' => 'This field is required',
            'email.required' => 'This field is required',
            'email.unique' => 'A user with this email already exists',
            'email.email' => 'This is a wrong email address',
            'type.required' => 'This field is required',
            'id_number.required' => 'This field is required',
            'id_number.unique' => 'A user with this number already exists',

        ];
    }
}
