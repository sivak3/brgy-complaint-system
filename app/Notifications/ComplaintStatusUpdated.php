<?php

namespace App\Notifications;

use App\Models\Complaint;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ComplaintStatusUpdated extends Notification
{
    use Queueable;

    public $complaint;

    public function __construct(Complaint $complaint)
    {
        $this->complaint = $complaint;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'complaint_id'  => $this->complaint->id,
            'title'         => $this->complaint->title,
            'status'        => $this->complaint->status,
            'message'       => 'Your complaint "' . $this->complaint->title . '" status has been updated to ' . ucfirst($this->complaint->status) . '.',
        ];
    }
}