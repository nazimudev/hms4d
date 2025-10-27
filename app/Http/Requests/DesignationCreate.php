<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesignationCreate extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'string|required|max:20',
            'description' => 'nullable|string|max:255'
        ];
    }


    public function message()
    {
        return [
            'name.required' => 'Designation name is required.',
            'name.string' => 'Designation name must be a string.',
            'name.max' => 'Designation name cannot exceed 20 characters.',
            'description.string' => 'Description must be a string.',
            'description.max' => 'Description cannot exceed 255 characters.',
        ];
    }
}
