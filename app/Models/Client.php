<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Client extends Authenticatable
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
        'active',
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

    public function address()
    {
        return $this->hasMany(ClientAddress::class)->latest();
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

    public function images()
    {
        return $this->hasMany(ClientImage::class);
    }

    public function fullAddress()
    {
        $address = $this->address[0];

        $full_address = $address->address . 
        ', ' . $address->number .
        ', ' . $address->area;

        if ($address->complement)
            $full_address .= ', ' . $address->complement;

        $full_address .= ' - ' . $address->cep .
            ' - ' . $address->city . '/' . $address->state;

        return $full_address;
    }
}
