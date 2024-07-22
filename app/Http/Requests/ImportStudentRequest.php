<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'student_name' => 'required|string|max:255',
            'registration_number' => 'required|max:255|unique:students,registration_number',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'gender' => 'required|string|max:10',
            'nida' => 'required|string|size:20|unique:students,nida',
            'ward' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'education_level' => 'required|string|max:255',
            'education_type' => 'required|string|max:255',
            'marital_status' => 'required|string|max:50',
            'employment_status' => 'required|string|max:50',
            'disability' => 'required|string|max:255',
            'phone_number' => 'nullable|string|size:10',
            'email' => 'nullable|email|max:255',
            'stage' => 'required|string|max:50',

            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|size:10',
            'parent_email' => 'nullable|email|max:255',
            'parent_address' => 'nullable|string|max:255',
            'parent_occupation' => 'required|string|max:255',
            'parent_disability' => 'required|string|max:255',
            'parent_ward' => 'required|string|max:255',
        ];
    }
}
