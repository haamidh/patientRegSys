<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
{
    public function authorize()
    {
        // Allow publicly if patients can self register; otherwise, restrict (admin)
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:patients,email,' . $this->route('patient'),
            'phone' => 'required|string|max:30',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
        ];
    }
}