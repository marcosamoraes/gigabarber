<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'client_uuid',
        'cep',
        'address',
        'number',
        'area',
        'complement',
        'city',
        'state',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
