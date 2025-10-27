<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'email' => [
                'required',
                'email',
                'max:191',
                // Ensure we pass the patient id (not the model) to the unique rule
                Rule::unique('patients', 'email')->ignore(optional($this->route('patient'))->id),
            ],
            'phone' => 'required|string|regex:/^[0-9]+$/',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
        ];
    }
}
