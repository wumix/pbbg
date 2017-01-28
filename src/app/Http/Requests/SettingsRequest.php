<?php

namespace Medusa\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // @todo check if any characters already exists that are not banned or dead
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
            'key'           =>  'required',
            'value' =>  'required',
            'type'          =>  'in:text,textarea,number,email'
        ];
    }
}
