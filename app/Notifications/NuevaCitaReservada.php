<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NuevaCitaReservada extends Notification
{
    use Queueable;

    public $cita;

    public function __construct($cita)
    {
        $this->cita = $cita;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; // Guardar en la base de datos y enviar en tiempo real con Echo
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Se ha reservado una nueva cita',
            'cita_id' => $this->cita->id,
            'fecha' => $this->cita->fecha,
            'usuario' => $this->cita->user->name . ' ' . $this->cita->user->apellido,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'Se ha reservado una nueva cita',
            'cita_id' => $this->cita->id,
            'fecha' => $this->cita->fecha,
            'usuario' => $this->cita->user->name . ' ' . $this->cita->user->apellido,
        ]);
    }
}
