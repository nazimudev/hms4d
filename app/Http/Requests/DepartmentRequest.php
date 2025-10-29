<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'floor' => 'nullable|string|max:50',
            'room_number' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500',
            'is_active' => 'sometimes|boolean',
        ];
    }


    // Validation Custom Messages
    public function messages(): array
    {
        return [
            'name.required' => 'Department name is required.',
            'name.string' => 'Department name must be a string.',
            'name.max' => 'Department name cannot exceed 255 characters.',

            'floor.string' => 'Floor must be a string.',
            'floor.max' => 'Floor cannot exceed 50 characters.',

            'room_number.string' => 'Room number must be a string.',
            'room_number.max' => 'Room number cannot exceed 50 characters.',

            'description.string' => 'Description must be a string.',
            'description.max' => 'Description cannot exceed 500 characters.',

            'is_active.boolean' => 'Status must be true or false.',
        ];
    }

}
