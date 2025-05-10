<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = [
        'name_of_society',
        'chairman',
        'vice_chairman',
        'manager',
        'registration_no',
        'lekha_parikshan_vargwari',
        'total_shakha',
        'district',
        'taluka',
        'registration_date',
        'karyashetra',
        'society_address',
        'audit_year',
        'auditor_id',
        'client_id',
    ];

    public function audit(){
        return $this->hasOne(Audit::class, 'id', 'auditor_id');
    }

    public function masterData(){
        return $this->hasMany(MasterData::class);
    }
}
