<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:patients,email',
            'phone' => 'required|string|regex:/^[0-9]+$/',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
        ];
    }
}
