<?php

namespace App\Notifications;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CancelAppointmentUser extends Notification
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
        $date = formatDate($this->appointment->date);
        $mail = (new MailMessage)
            ->subject('Você cancelou um agendamento')
            ->greeting("Olá, {$this->user->name}!")
            ->line("Você cancelou o agendamento no {$this->client->company_name}!")
            ->line("Nome: {$this->user->name}")
            ->line("E-mail: {$this->user->email}")
            ->line("Whatsapp: {$this->user->whatsapp}")
            ->line("CPF: {$this->user->cpf}")
            ->line("Data do agendamento: {$date}");

        $sum = 0;
        foreach ($services as $service) {
            $name = explode(' - ', $service);
            $service = Service::where('title', $name[1])
                ->whereHas('category', function ($query) use ($name) {
                    $query->where('name', $name[0]);
                })->first();
            $sum += $service->value;
            $value = number_format($service->value, 2, ',', '.');
            $mail->line("Serviço: {$service->category->name} - {$service->title}: {$service->description} (R${$value})");
        }
        $sum = number_format($sum, 2, ',', '.');
        $mail->line("Valor Total: R${$sum}");

        return $mail;
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
