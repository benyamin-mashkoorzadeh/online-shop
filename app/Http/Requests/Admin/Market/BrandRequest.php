<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'persian_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ئء., ٔ]+$/u',
                'original_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ئء., ٔ]+$/u',
                'logo' => 'required|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ئء., ٔ]+$/u'
            ];
        }
        else {
            return [
                'persian_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ئء., ٔ]+$/u',
                'original_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ئء., ٔ]+$/u',
                'logo' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ئء., ٔ]+$/u'
            ];
        }
    }
}
