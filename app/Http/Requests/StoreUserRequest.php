<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required','min:3'],
             'email'=>['email','required','unique:users'],
             'phone_number'=>['numeric','digits:8','required','unique:users'],
             'password'=>['confirmed',Password::min(8)->letters()->numbers()->symbols()->mixedCase(),'required'],
             'role'=>['required'],
         ];
    }

    public function messages(): array
    {
        return [
            'email.unique'=>'this email is already taken',
            'email.email'=>'this must be a valid email address.',
            'email.required'=>'email field is required',
            'name.required'=>'name field is required',
            'password.min'=>'the password field must contain at least 8 characters',
            'password.confirmed'=>'the confirmation field doesn\'t match',
            'password.required'=>'password field is required',
            'role.required'=>'Select a role for the User',
            'phone_number.unique'=>'phone number must be unique'
        ];
    }
}
