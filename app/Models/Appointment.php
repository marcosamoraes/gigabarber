<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'user_uuid',
        'client_uuid',
        'services',
        'date',
    ];

    public function client()
    {
        return $this->BelongsTo(Client::class);
    }

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
