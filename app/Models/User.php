<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;
    
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'name',
        'email',
        'whatsapp',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
