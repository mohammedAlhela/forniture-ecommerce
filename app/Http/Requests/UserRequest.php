<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = app('request')->get('id');

        return [
            'username' => ['unique:users,username,' . $id, 'required', 'min:3', 'string', 'max:255'],
            'email' => ['unique:users,email,' . $id , 'required', 'min:3', 'string', 'email', 'max:255' ],
            'image' => [ 'nullable' , 'image'],
            'password' => [  $id ? 'nullable' : 'required' , 'string' , 'min:8' , 'confirmed']

        ];
    }


}
