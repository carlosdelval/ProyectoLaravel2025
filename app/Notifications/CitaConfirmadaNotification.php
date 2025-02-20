<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class CitaConfirmadaNotification extends Notification
{
    use Queueable;

    protected $cita;

    public function __construct($cita)
    {
        $this->cita = $cita;
    }

    // Canal de la notificación (base de datos)
    public function via($notifiable)
    {
        return ['database'];
    }

    // Mensaje que se guarda en la DB
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Tu cita del ' . $this->cita->fecha . ' a las ' . $this->cita->hora . ' ha sido confirmada.',
            'url' => route('citas.index'),
        ];
    }
}
