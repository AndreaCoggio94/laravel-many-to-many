<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
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
            'name' => ['required','string', Rule::unique('projects') ],
           
            'description' => ['nullable','string'],
            'repository' => ['nullable','string'],
            'type_id'=> ['nullable', 'exists:types,id'],
            'technologies' => ['nullable','exists:technologies,id'],
            'cover_image'=> ['nullable', 'image', 'max:512'],
            
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name is required',
            'name.string' => 'The name must be a string',
            'name.unique' => 'The name must be unique',

            'description.string' => 'The description must be a string',
            
            'repository.string' => 'The thumb must be a url',

            'type_id.exists'=> 'The inserted Type is not valid',

            'technologies.exist' => 'The inserted Technologies are not valid',

            'cover_image.image' => 'The file must be an image',
            'cover_image.max' => 'The loaded file must be under 512KB '
        ];
    }
}