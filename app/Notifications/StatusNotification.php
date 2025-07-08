<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB; 


// app/Notifications/StatusNotification.php
use Illuminate\Notifications\Messages\DatabaseMessage;
class StatusNotification extends Notification
{
    use Queueable;

    public $message;
    public $reservationId;
    public $type;

    public function __construct($message, $reservationId, $type)
    {
        $this->message = $message;
        $this->reservationId = $reservationId;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['database']; // ✅ DB mein save hoga
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'reservation_id' => $this->reservationId,
            'type' => $this->type,
        ];
    }
}
