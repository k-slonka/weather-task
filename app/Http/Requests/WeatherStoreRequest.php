<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeatherStoreRequest extends FormRequest
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
            'cities' => [
                'required',
                'array'
            ],
            'cities.*' => [
                'required',
                'string',
                'max:50'
            ]
        ];
    }

    public function messages()
    {
        return [
            'cities.required' => 'Array with city name is required.',
            'cities.array' => 'Type need be array.',
            'cities.*.required' => 'Name of city is required',
            'cities.*.string' => 'Name of city need be type of string.',
            'cities.*.max:50' => 'Name of city can have maximum 50 characters.',
        ];
    }
}
