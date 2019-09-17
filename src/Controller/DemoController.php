<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Notification\DemoNotification;
use SN\Notifications\NotificationSender;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    /**
     * @Route("/")
     *
     * @param RegistryInterface $registry
     * @param NotificationSender $notificationSender
     *
     * @return Response
     */
    public function test(RegistryInterface $registry, NotificationSender $notificationSender): Response
    {
        $em = $registry->getManager();
        $user = $registry->getRepository(User::class)->findOneBy(['name' => 'Demo']);

        if (null === $user) {
            $user = new User();
            $em->persist($user);
            $em->flush();
        }

        $notification = new DemoNotification();
        $notificationSender->send($user, $notification);

        return $this->render('base.html.twig', [
            'user' => $user,
        ]);
    }
}
