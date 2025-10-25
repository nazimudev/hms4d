<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // true দিলে request authorized হবে
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'relative_name' => 'nullable|string|max:255',
            'relative_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'marital_status' => 'nullable|in:single,married,divorced,widowed',
            'blood_group' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'religion' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:100',
            'nid' => 'nullable|string|max:50',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:5120', // up to 5MB
            'joining_date' => 'nullable|date',
            'designation' => 'nullable|string|max:100',
            'employee_id' => 'nullable|string|max:50|unique:user_informations,employee_id',
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'User ID is required.',
            'user_id.exists' => 'The selected user does not exist.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'Image must be in JPG, JPEG, or PNG format.',
            'image.max' => 'Image size cannot exceed 2MB.',
            'cv.mimes' => 'CV must be in PDF, DOC, or DOCX format.',
            'cv.max' => 'CV size cannot exceed 5MB.',
            'gender.in' => 'Gender must be one of: male, female, or other.',
            'marital_status.in' => 'Invalid marital status selected.',
            'blood_group.in' => 'Invalid blood group.',
            'employee_id.unique' => 'Employee ID must be unique.',
        ];
    }
}
