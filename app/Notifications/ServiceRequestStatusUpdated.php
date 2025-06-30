<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\ServiceRequest;

class ServiceRequestStatusUpdated extends Notification
{
    use Queueable;

    public $serviceRequest;

    public function __construct(ServiceRequest $serviceRequest)
    {
        $this->serviceRequest = $serviceRequest;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // ✅ DB + Mail
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Service Request Updated')
            ->line('Your service request status is now: ' . $this->serviceRequest->status);
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your service request #' . $this->serviceRequest->id . ' has been updated to ' . $this->serviceRequest->status,
        ];
    }
}
