<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $login
 * @property mixed $password
 * @property mixed $remember
 */
class LoginRequest extends FormRequest
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
            'login' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'login.required' => __('area.login_empty'),
            'password.required' => __('area.password_empty'),
        ];
    }
}
