<?php

namespace App\Models;

use App\Notifications\NewAppointmentClient;
use App\Notifications\NewAppointmentUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

class Appointment extends Model
{
    use HasFactory;
    use HasUuids;
    use Notifiable;
    
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

    public function sendNewAppointment()
    {
        Notification::route('mail', [
            $this->client->email => $this->client->name,
        ])->notify(new NewAppointmentClient($this));
        
        Notification::route('mail', [
            $this->user->email => $this->user->name,
        ])->notify(new NewAppointmentUser($this));
    }
}
