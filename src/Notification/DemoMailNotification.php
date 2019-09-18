<?php

declare(strict_types=1);

namespace App\Notification;

use SN\Notifications\Contracts\EmailInterface;
use SN\Notifications\Contracts\MailableInterface;
use SN\Notifications\Contracts\NotifiableInterface;
use SN\Notifications\Contracts\NotificationInterface;
use SN\Notifications\Email\Email;

class DemoMailNotification implements NotificationInterface, MailableInterface
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param NotifiableInterface $notifiable
     *
     * @return EmailInterface
     */
    public function toMail(NotifiableInterface $notifiable): EmailInterface
    {
        return (new Email())
            ->subject('The introduction to the notification.')
            ->text('Thank you for using our application!');
    }
}
