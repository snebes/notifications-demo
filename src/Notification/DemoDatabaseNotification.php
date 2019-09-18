<?php

declare(strict_types=1);

namespace App\Notification;

use SN\Notifications\Contracts\ArrayableInterface;
use SN\Notifications\Contracts\NotifiableInterface;
use SN\Notifications\Contracts\NotificationInterface;

class DemoDatabaseNotification implements NotificationInterface, ArrayableInterface
{
    /**
     * Get the notification's delivery channels.
     *
     * @param NotifiableInterface $notifiable
     *
     * @return array
     */
    public function via(NotifiableInterface $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param NotifiableInterface $notifiable
     *
     * @return array
     */
    public function toArray(NotifiableInterface $notifiable): array
    {
        return [
            'message' => 'This is a database notification sent at ' . \date(DATE_COOKIE),
        ];
    }
}
