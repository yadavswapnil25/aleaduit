<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreYearRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'audit_year' => 'required|string|unique:years,audit_year,NULL,id,client_id,' . $this->client_id,
            'auditor_id' => 'required',
            'client_id' => 'required|exists:clients,id',
            'file' => 'nullable|file|mimes:doc,docx', // Validate the file
        ];
    }

    public function messages()
    {
        return [
            'audit_year.unique' => 'Year ' . $this->audit_year . ' already exists for this client.',
        ];
    }
}
