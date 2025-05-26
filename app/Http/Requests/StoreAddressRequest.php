<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
        'type'              => 'required|string|max:255',
        'name'              => 'nullable|string|max:255',
        'street_address'    => 'required|string|max:255',
        'apartment_address' => 'required|string|max:255',
        'area_id'           => 'required|integer',
        'zip_code'          => 'required|digits_between:4,10',
        'latitude'          => 'required|string|max:255',
        'longitude'         => 'required|string|max:255',
        'is_primary'        => 'required|boolean',
        'contact_name'      => 'required|string|max:255',
        'contact_phone'     => 'required|string|max:20',
        'addressable_type'  => 'required|string|max:255',
        'addressable_id'    => 'required|integer',
        ];
    }
}
