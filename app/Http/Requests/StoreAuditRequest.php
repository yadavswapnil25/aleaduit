<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\AuditTypeEnum;

class StoreAuditRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'type' => ['required', new Enum(AuditTypeEnum::class)],
            'namtalika_vargwari' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255|unique:audits',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:255',
            'javak_kramank' => 'required|string|max:255',
            'date' => 'required|date',
        ];
    }
}
