<?php

namespace App\Http\Requests;

class PasswordRequest extends FormRequest
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
            'password' => 'min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed' => __('area.user_password_confirmation_failed'),
            'password.*' => __('area.user_password_failed'),
        ];
    }
}
