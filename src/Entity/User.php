<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use SN\Bundle\NotificationsBundle\Entity\Notification;
use SN\Notifications\Contracts\NotifiableInterface;
use SN\Notifications\NotifiableTrait;

/**
 * @ORM\Entity()
 */
class User implements NotifiableInterface
{
    use NotifiableTrait;

    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name = 'Demo';

    /**
     * @var string
     */
    private $email = 'demo@example.com';

    /**
     * @var string
     */
    private $phoneNumber = '+1 555 555 5555';

    /**
     * @var Notification[]
     *
     * @ORM\ManyToMany(targetEntity=Notification::class)
     * @ORM\JoinTable(name="user_notifications")
    */
    private $notifications;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id ?? 0;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return self
     */
    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }
}
