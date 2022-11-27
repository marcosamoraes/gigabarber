<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Client extends Authenticatable
{
    use HasFactory, HasUuids, SoftDeletes, Notifiable;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'uuid',
        'name',
        'company_name',
        'email',
        'email_verified_at',
        'whatsapp',
        'cnpj',
        'logo',
        'profile',
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
            $model->password = Hash::make($model->password);
        });
    }

    public function users()
    {
        return $this->hasMany(User::class);
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

    public function hours()
    {
        return $this->hasMany(ClientHours::class)
            ->orderBy('day', 'asc')
            ->orderBy('open_time', 'asc');
    }

    public function fullAddress()
    {
        if (!isset($this->address[0]))
            return false;

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
