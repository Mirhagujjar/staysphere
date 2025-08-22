<?php

namespace App\Models;


use Kreait\Firebase\Messaging\CloudMessage;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Factory;

class NotificationHelper
{

    public static function sendNotificationWithPayload($topic, $title, $body)
    {
        $data = [
            'title' => $title,
            'body' => $body
        ];
        try {
            $messaging = (new Factory)
                ->withServiceAccount(base_path('login-app-adminsdk.json'))
                ->createMessaging();
            // dd($payload);
            $message = CloudMessage::new()
                ->withTarget('topic', $topic)
                ->withNotification($data)
                ->withData($data);

            return $messaging->send($message);
            return true;
        } catch (\Exception $e) {
            Log::channel('noti')->info($e->getMessage());
            return $e->getMessage();
        }
                // return "Notification sent to topic: $topic with title: $title and body: $body";

    }

}