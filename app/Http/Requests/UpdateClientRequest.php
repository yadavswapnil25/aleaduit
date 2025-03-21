<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_of_society' => 'required|string|max:255',
            'chairman' => 'required|string|max:255',
            'vice_chairman' => 'required|string|max:255',
            'manager' => 'required|string|max:255',
            'registration_no' => 'required|string',
            'lekha_parikshan_vargwari' => 'required|string|max:255',
            'total_shakha' => 'required|integer',
            'district' => 'required|string|max:255',
            'taluka' => 'required|string|max:255',
            'registration_date' => 'required|date',
            'karyashetra' => 'required|string|max:255',
            'society_address' => 'required|string|max:255',
        ];
    }
}
