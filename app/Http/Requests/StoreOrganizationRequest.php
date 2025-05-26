<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationRequest extends FormRequest
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
            'name'           => 'required|string|max:255|unique:organizations,name',
            'parent_id'      => 'nullable|exists:organizations,id',
            'type'           => 'required|string|in:private,public',
            'contact_email'  => 'nullable|email|max:255',
            'contact_name'   => 'nullable|string|max:255',
            'website_url'    => 'nullable|url|max:255',
            'founded_at'     => 'nullable|date',
        ];
    }
}
