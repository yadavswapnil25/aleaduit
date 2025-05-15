<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\AuditTypeEnum;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'namtalika_vargwari',
        'district',
        'registration_number',
        'address',
        'email',
        'phone_number',
        'javak_kramank',
        'date',
        'user_id',
    ];

    protected $casts = [
        'type' => AuditTypeEnum::class,
    ];
}
