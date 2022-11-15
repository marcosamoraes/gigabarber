<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAppointmentUser extends Notification
{
    use Queueable;

    public $appointment;
    public $client;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
        $this->client = $appointment->client;
        $this->user = $appointment->user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $services = json_decode($this->appointment->services);
        $services = is_array($services) ? implode(',', $services) : $services;
        $date = formatDate($this->appointment->date);
        return (new MailMessage)
            ->subject('Você realizou um agendamento!')
            ->greeting("Olá, {$this->user->name}!")
            ->line("Você realizou um agendamento no {$this->client->company_name}!")
            ->line("Nome: {$this->user->name}")
            ->line("E-mail: {$this->user->email}")
            ->line("Whatsapp: {$this->user->whatsapp}")
            ->line("CPF: {$this->user->cpf}")
            ->line("Serviços: {$services}")
            ->line("Data do agendamento: {$date}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
