<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInput extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'key',
        'value',
        'sheet_no',
    ];

}
