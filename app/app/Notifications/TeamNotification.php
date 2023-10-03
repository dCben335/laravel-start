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
    private $joinedTeam;

    public function __construct(string $addedUserName, string $addedByUserName,string $joinedTeam ,string $addedDateTime)
    {
        $this->addedUserName = $addedUserName;
        $this->addedByUserName = $addedByUserName;
        $this->addedDateTime = $addedDateTime;
        $this->joinedTeam = $joinedTeam;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Une Nouvelle personne ajoutée à l\'équipe' . $this->joinedTeam)
            ->line('Nom de l\'utilisateur ajouté: ' . $this->addedUserName)
            ->line('Ajouté par: ' . $this->addedByUserName)
            ->line('Date et heure de l\'ajout: ' . $this->addedDateTime)
            ->action('Voir l\'équipe', url('/'));
    }

    /**
     * Get the array representation of the notification.
     *
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Nouvelle personne ajoutée à l\'équipe',
            'added_user_name' => $this->addedUserName,
            'added_by_user_name' => $this->addedByUserName,
            'added_datetime' => $this->addedDateTime,
        ];
    }
}
?>