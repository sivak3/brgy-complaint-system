<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMessageReceived extends Notification
{
    use Queueable;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message_id'  => $this->message->id,
            'sender_name' => $this->message->sender->name,
            'body'        => \Str::limit($this->message->body, 80),
            'message'     => $this->message->sender->name . ' sent you a message: "' . \Str::limit($this->message->body, 60) . '"',
            'type'        => 'message',
        ];
    }
}