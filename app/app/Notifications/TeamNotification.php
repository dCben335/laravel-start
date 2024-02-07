<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeamNotification extends Notification
{
    use Queueable;

    private $addedUserName;
    private $addedByUserName;
    private $addedDateTime;
    private $teamUrl;
    private $joinedTeam;

    public function __construct(string $addedUserName, string $addedByUserName, string $joinedTeam, string $teamUrl, string $addedDateTime)
    {
        $this->addedUserName = $addedUserName;
        $this->addedByUserName = $addedByUserName;
        $this->joinedTeam = $joinedTeam;
        $this->teamUrl = $teamUrl;
        $this->addedDateTime = $addedDateTime;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line(__('notifications.added_to') . ' ' . $this->joinedTeam)
            ->line(__('notifications.added_user') . ' ' . $this->addedUserName)
            ->line(__('notifications.added_by') . ' ' . $this->addedByUserName)
            ->line(__('notifications.added_at') . ' ' . $this->addedDateTime)
            ->action(__('notifications.added_button'), url($this->teamUrl));
    }

    /**
     * Get the array representation of the notification.
     *
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => __('notifications.added_to') . ' ' . $this->joinedTeam,
            'added_user_name' => $this->addedUserName,
            'added_by_user_name' => $this->addedByUserName,
            'added_datetime' => $this->addedDateTime,
        ];
    }
}
?>