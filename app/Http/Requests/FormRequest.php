<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as DefaultFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormRequest extends DefaultFormRequest
{
    protected $stopOnFirstFailure = true;

    protected function failedValidation(Validator $validator)
    {
        if($this->expectsJson())
            throw new HttpResponseException(response()->json([
                'message' => $validator->errors()->first()
            ], 422));

        parent::failedValidation($validator);
    }
}
