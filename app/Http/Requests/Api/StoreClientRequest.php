<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:13',
            'email' => 'email:rfc,dns|unique:clients,email',
            'client_type_id' => 'exists:client_types,id',
            'client_status_id' => 'exists:client_statuses,id',
            'title' => 'string|max:255',
            'address' => 'required|string',
            'description' => 'string',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];
    }
}
