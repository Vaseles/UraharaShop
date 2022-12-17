<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'phone' => ['required', 'min: 10'],

            'country' => ['required', 'min:3'],
            'city' => ['required','min:1'],
            'address' => ['required', 'min:2'],
            'postalCode' => ['required', 'min:2'],

            'count' => ['required'],

            'payMethod' => ['required'],
        ];
    }
}
