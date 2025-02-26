<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class CitaGraduada extends Notification
{
    use Queueable;

    public $cita;

    /**
     * Create a new notification instance.
     */
    public function __construct($cita)
    {
        $this->cita = $cita;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database', 'mail']; // Se enviará por BD y correo
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Tu cita ha sido graduada 🎉')
                    ->greeting('¡Hola ' . $notifiable->name . '!')
                    ->line('Te informamos que tu cita con la óptica ' . $this->cita->optica->nombre . ' ha sido graduada.')
                    ->action('Ver Detalles', url('/citas'))
                    ->line('¡Gracias por confiar en nosotros!');
    }

    /**
     * Guardar en la base de datos.
     */
    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'mensaje' => 'Tu cita del día ' . $this->cita->fecha . ' ha sido graduada. ¡Ya puedes comprobar tus datos!',
            'cita_id' => $this->cita->id,
            'fecha' => $this->cita->fecha,
        ]);
    }
}
