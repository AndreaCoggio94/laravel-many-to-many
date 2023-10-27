<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnologyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'label' => ['required', 'string', 'max:30'],
            'colour' => ['required', 'string', 'max:7'],
            
        ];
    }

    public function messages()
    {
        return [
            'label.required' => 'The label is required',
            'label.string' => 'The label must be a string',
            'label.max' => 'The label must have a maximum of 30 characters',

            'colour.required' => 'The colour is required',
            'colour.string' => 'The colour must be a string',
            'colour.max' => 'The colour must have a maximum of 7 characters'
        ];
    }
}