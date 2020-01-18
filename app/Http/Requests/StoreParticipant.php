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
            'name.required' => 'Este campo no puede estar vacio',
            'lastname.required' => 'Este campo no puede estar vacio',
            'email.required' => 'Este campo no puede estar vacio',
            'email.unique' => 'Ya se encuentra un participante con este email',
            'email.email' => 'Debes ingresar una direccion valida',
            'type.required' => 'Este campo no puede estar vacio',
            'id_number.required' => 'Este campo no puede estar vacio',
            'id_number.unique' => 'Ya se encuentra un participante con este numero de cedula',

        ];
    }
}
