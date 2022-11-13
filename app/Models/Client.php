<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class Client extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'whatsapp',
        'cnpj',
        'logo',
        'favicon',
        'views',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->slug = Str::slug($model->company_name.'-'.rand(1000,9999), '-');
        });
    }

    public function addresses()
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function attributes()
    {
        return $this->hasOne(ClientAttribute::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
