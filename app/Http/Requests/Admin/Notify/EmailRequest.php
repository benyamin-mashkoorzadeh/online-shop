<?php

namespace App\Http\Requests\Admin\Notify;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            'subject' => 'required|max:120|min:3|regex:/^[ا-یa-zA-Z0-9\-۰-۹ئء., ٔ]+$/u',
            'body' => 'required|max:500|min:5|regex:/^[ا-یa-zA-Z0-9\-۰-۹ئء., <>\/;\n\r&ٔ]+$/u',
            'status' => 'required|numeric|in:0,1',
            'published_at' => 'required|numeric'
        ];
    }
}
