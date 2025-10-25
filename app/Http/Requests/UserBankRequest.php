<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserBankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // must be true to allow validation
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:bank,mobile',
        ];

        // ✅ For BANK account type
        if ($this->input('type') === 'bank') {
            $rules = array_merge($rules, [
                'bank_name' => 'required|string|max:255',
                'branch_name' => 'required|string|max:255',
                'account_holder_name' => 'required|string|max:255',
                'account_number' => 'required|string|max:50|unique:bank_accounts,account_number',
                'mobile_service_name' => 'nullable|string|max:50',
                'mobile_number' => 'nullable|string|max:20',
            ]);
        }

        // ✅ For MOBILE account type
        if ($this->input('type') === 'mobile') {
            $rules = array_merge($rules, [
                'mobile_service_name' => 'required|string|in:bkash,nagad,rocket,upay',
                'mobile_number' => 'required|string|max:20|unique:bank_accounts,mobile_number',
                'bank_name' => 'nullable|string|max:255',
                'branch_name' => 'nullable|string|max:255',
                'account_holder_name' => 'nullable|string|max:255',
                'account_number' => 'nullable|string|max:50',
            ]);
        }

        return $rules;
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
            'type.required' => 'Account type is required.',
            'type.in' => 'Account type must be either bank or mobile.',

            // Bank account messages
            'bank_name.required' => 'Bank name is required for bank accounts.',
            'branch_name.required' => 'Branch name is required for bank accounts.',
            'account_holder_name.required' => 'Account holder name is required.',
            'account_number.required' => 'Account number is required.',
            'account_number.unique' => 'This account number already exists.',

            // Mobile account messages
            'mobile_service_name.required' => 'Mobile service name is required for mobile accounts.',
            'mobile_service_name.in' => 'Mobile service must be one of: bkash, nagad, rocket, upay.',
            'mobile_number.required' => 'Mobile number is required for mobile accounts.',
            'mobile_number.unique' => 'This mobile number already exists.',
        ];
    }
}
