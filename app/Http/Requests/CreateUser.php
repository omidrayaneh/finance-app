<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'status' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name character minimum 3  is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is exist',
            'email.email' => 'Email is not correct',
            'password.min' => 'Password Minimum character 6 is required',
            'password.required' => 'Password is required',
            'status.required' => 'Status is required'
        ];
    }
}
