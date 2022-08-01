<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Rule;

abstract class SpecsRequest extends FormRequest
{
    protected string $type;

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
        $params = implode(',', array_keys(Lang::get('specs.' . $this->type)));

        $id = !empty($this->device) ? $this->device->id : 0;

        $rules = [
            'vendor_id' => 'bail|required||integer|numeric',
            'name' => 'bail|required|max:127|regex:/^[A-Za-z0-9_\-\.\+ ]+$/',
            'slug' => ['bail','required','max:127','regex:/^[a-z0-9\-\.]+$/', Rule::unique('specs_' . $this->type . 's')->ignore($id)],
            'data' => 'bail|required|array:'.$params,
        ];

        if ($this->id)
            $rules['id'] = 'integer|numeric';

        return $rules;
    }

    public function messages()
    {
        return [
            'vendor_id.*' => __('specs.vendor_failed'),
            'name.*' => __('specs.name_failed'),
            'slug.unique' => __('specs.slug_exists'),
            'slug.*' => __('specs.slug_failed'),
            'data.*' => __('specs.data_failed'),
        ];
    }
}
