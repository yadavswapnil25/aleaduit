<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterData extends Model
{
    protected $table = 'master_data';

    protected $fillable = [
        'master',
        'menu',
        'entity',
        'lastYear',
        'currentYear',
        'bankAmount'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
