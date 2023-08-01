<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
             'name'=>['required','min:3'],
             'phone_number'=>['numeric','digits:8','unique:users,phone_number,'.$this->user->id],
             'email'=>['email','required','unique:users,email,'.$this->user->id],
             'password'=>['confirmed',Password::min(8)->letters()->numbers()->symbols()->mixedCase(),'required']
         ];
    }

    public function messages(): array
    {
        return [
            'email.unique'=>'this email is already taken',
            'email.email'=>'this must be a valid email address.',
            'email.required'=>'email field is required',
            'name.required'=>'name field is required',
            'password.letters'=>'the password field must contain at least one letter',
            'password.numbers'=>'the password field must contain at least one number',
            'password.min'=>'the password field must contain at least 8 characters',
            'password.confirmed'=>'the confirmation field doesn\'t match',
            'password.required'=>'password field is required',
            'phone_number.unique'=>'phone number must be unique'
        ];
    }
}
