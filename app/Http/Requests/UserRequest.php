<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

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
        $id = !empty($this->user) ? $this->user->id : 0;

        $rules = [
            'name' => ['bail', 'required', 'min:2', 'max:255', 'regex:/^[A-Za-z0-9_\-\. ]+$/', Rule::unique('users')->ignore($id)],
            'login' => ['bail', 'required', 'min:2', 'max:255', 'regex:/^[A-Za-z0-9_\-\.]+$/', Rule::unique('users')->ignore($id)],
            'email' => ['bail', 'required', 'min:2', 'max:255', 'email:rfc,filter', Rule::unique('users')->ignore($id)],
            'permissions' => 'array',
            'permissions.*' => 'integer',
        ];
        if ($this->password || !$id) {
            $rules['password'] = 'min:8';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.unique' => __('area.user_name_taken'),
            'name.*' => __('area.user_name_failed'),

            'login.unique' => __('area.user_login_taken'),
            'login.*' => __('area.user_login_failed'),

            'email.unique' => __('area.user_email_taken'),
            'email.*' => __('area.user_email_failed'),

            'password.min' => __('area.user_password_failed'),

            'permissions.*' => __('area.wrong_permissions'),
            'permissions.*.*' => __('area.wrong_permissions'),
        ];
    }
}
