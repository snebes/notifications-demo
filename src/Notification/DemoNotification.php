<?php

namespace App\Notification;

use SN\Notifications\Contracts\EmailInterface;
use SN\Notifications\Contracts\NotifiableInterface;
use SN\Notifications\Contracts\NotificationInterface;
use SN\Notifications\Email\Email;

class DemoNotification implements NotificationInterface
{
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param NotifiableInterface $notifiable
     *
     * @return array
     */
    public function via(NotifiableInterface $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param NotifiableInterface $notifiable
     *
     * @return \SN\Notifications\Contracts\EmailInterface
     */
    public function toMail(NotifiableInterface $notifiable): EmailInterface
    {
        return (new Email())
            ->subject('The introduction to the notification.')
            ->text('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param NotifiableInterface $notifiable
     *
     * @return array
     */
    public function toDatabase(NotifiableInterface $notifiable): array
    {
        return [
            'message' => 'This is a demo notification sent at ' . \date(DATE_RFC2822),
        ];
    }
}
