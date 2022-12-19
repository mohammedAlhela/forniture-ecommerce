<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'first_name' => [ 'required', 'min:2', 'string', 'max:255'],
            'last_name' => [ 'required', 'min:2', 'string', 'max:255'],
            'email' => ['required', 'min:3', 'string', 'email', 'max:255'],
            'phone_number' => [ 'required' ],
            'image' => [ 'nullable' , 'image'],
            'employee_type' => ['required']
        ];
    }


}
