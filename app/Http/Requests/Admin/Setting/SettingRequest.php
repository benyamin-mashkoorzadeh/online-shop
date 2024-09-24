<?php

namespace App\Http\Requests\Admin\Setting;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title' => 'required|max:120|min:3|regex:/^[ا-یa-zA-Z0-9\-۰-۹ئء., ٔ]+$/u',
            'description' => 'required|max:500|min:5|regex:/^[ا-یa-zA-Z0-9\-۰-۹ئء., ٔ]+$/u',
            'keywords' => 'required|max:500|min:5|regex:/^[ا-یa-zA-Z0-9\-۰-۹ئء., ٔ]+$/u',
            'logo' => 'image|mimes:png,jpg,jpeg,gif',
            'icon' => 'image|mimes:png,jpg,jpeg,gif'
        ];
    }
}
