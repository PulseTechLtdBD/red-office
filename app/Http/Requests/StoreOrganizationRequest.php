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
            'name'                       => 'required|string|max:255|unique:organizations,name',
            'parent_id'                  => 'nullable|exists:organizations,id',
            'type'                       => 'required|string|in:private,public',
            'contact_email'              => 'nullable|email|max:255',
            'contact_name'               => 'nullable|string|max:255',
            'website_url'                => 'nullable|url|max:255',
            'founded_at'                 => 'nullable|date',
            'org_address_type'           => 'required|string|in:org,branch', // assuming limited types
            'org_address_name'           => 'required|string|max:255',
            'org_address_street_address' => 'nullable|string|max:255',
            'org_address_office_address' => 'nullable|string|max:255',
            'org_address_area_id'        => 'nullable|exists:areas,id',
            'org_address_zip_code'       => 'nullable|string|max:20',
            'org_address_latitude'       => 'nullable|numeric|between:-90,90',
            'org_address_longitude'      => 'nullable|numeric|between:-180,180',
            'org_address_is_primary'     => 'required|boolean',
            'org_address_contact_name'   => 'nullable|string|max:255',
            'org_address_contact_phone'  => 'nullable|string|max:20',
        ];
    }
}
