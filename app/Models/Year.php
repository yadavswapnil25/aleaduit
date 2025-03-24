<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = [
        'audit_year',
        'auditor_id',
        'client_id',
        'file',
    ];

    public function auditor()
    {
        return $this->belongsTo(User::class, 'auditor_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
