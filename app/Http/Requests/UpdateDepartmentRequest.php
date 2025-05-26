<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
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
            'name'                  => 'required|string|max:255|unique:departments,name',
            'code'                  => 'nullable|string|max:255|unique:departments,code',
            'description'           => 'nullable|string|max:1000',
            'head_of_department_id' => 'nullable|exists:users,id',
            'parent_department_id'  => 'nullable|exists:departments,id',
            'budget'                => 'nullable|numeric|min:0|max:99999999.99',
            'contact_email'         => 'nullable|email|max:255',
            'contact_phone'         => 'nullable|string|max:11',
        ];
    }
}
