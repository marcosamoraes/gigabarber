<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, HasUuids;
    
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'name',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
