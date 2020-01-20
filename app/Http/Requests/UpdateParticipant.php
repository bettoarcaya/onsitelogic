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
            'id.required' => 'Este campo no puede estar vacio',
            'name.required' => 'Este campo no puede estar vacio',
            'lastname.required' => 'Este campo no puede estar vacio',
            'email.required' => 'Este campo no puede estar vacio',
            'email.email' => 'Debes ingresar una direccion valida',
            'id_number.required' => 'Este campo no puede estar vacio',

        ];
    }
}
