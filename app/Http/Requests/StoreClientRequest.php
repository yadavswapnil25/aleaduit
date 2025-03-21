<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_of_society' => 'required',
            'chairman' => 'required',
            'vice_chairman' => 'required',
            'manager' => 'required',
            'registration_no' => 'required|unique:clients',
            'lekha_parikshan_vargwari' => 'required',
            'total_shakha' => 'required',
            'district' => 'required',
            'taluka' => 'required',
            'registration_date' => 'required',
            'karyashetra' => 'required',
            'society_address' => 'required',
        ];
    }
}
