<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // dd($this->all());
        return [
            'en.name' => ['required', 'string', 'max:255'],
            'en.description' => ['required', 'string', 'max:255'],
            'ar.name' => ['required', 'string', 'max:255'],
            'ar.description' => ['required', 'string', 'max:255'],
        ];
    }
    public function message(): array
    {
        return  [
            'name.required' => 'The name category is requried',
            'description.required' => 'The description category is requried',
            'string' => 'The type must be string',
            'max' => 'The max length 255 letter',
        ];
    }
}
