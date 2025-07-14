<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserProfileRequest extends FormRequest
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
            'user_id'                  => 'required|exists:users,id',
            'first_name'               => 'required|string|max:255',
            'middle_name'              => 'nullable|string|max:255',
            'last_name'                => 'nullable|string|max:255',
            'father_name'              => 'nullable|string|max:255',
            'mother_name'              => 'nullable|string|max:255',
            'spouse_name'              => 'nullable|string|max:255',
            'designation_id'           => 'required|exists:designations,id',
            'department_id'            => 'required|exists:departments,id',
            'joined_at'                => 'nullable|date',
            'employee_type'            => 'required|string|in:fulltime,parttime,contract,intern', // customize as needed
            'date_of_birth'            => 'required|date|before:today',
            'gender'                   => 'required|string|in:male,female,other', // adjust options as needed
            'blood_group'              => 'nullable|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-', // optional validation
            'national_id'              => 'nullable|string|max:50',
            'employee_id'              => 'nullable|string|max:50',
            'passport_no'              => 'nullable|string|max:50',
            'driving_license_no'       => 'nullable|string|max:50',
            'employee_status'          => 'required|boolean',
            'marital_status'           => 'nullable|string|in:single,married,divorced,widowed', // adjust as needed
            'religion'                 => 'nullable|string|max:100',
            'nationality'              => 'required|string|max:100',
            'emergency_contact_name'   => 'required|string|max:255',
            'emergency_contact_number' => 'required|string|max:20', // validate format if needed
            'profile_picture_src'      => 'nullable|file|image|max:2048', // or use 'image' if handling uploads
        ];
    }
}
