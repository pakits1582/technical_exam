<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
            'first_name' => ['required','string', 'max:255', Rule::unique('employees')->where(fn ($query) => $query
                                                                                ->where('last_name', $this->last_name)
                                                                                )->ignore($this->employee->id)],
            'last_name' => ['required','string', 'max:255',  Rule::unique('employees')->where(fn ($query) => $query
                                                                                ->where('first_name', $this->first_name)
                                                                                )->ignore($this->employee->id)],
            'factory_id' => 'required|exists:factories,id',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
        ];
    }
}
