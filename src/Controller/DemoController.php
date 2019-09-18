<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Notification\DemoNotification;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use SN\Bundle\NotificationsBundle\Entity\Notification;
use SN\Notifications\NotificationSender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    /**
     * @Route("/", name="demo")
     *
     * @param NotificationSender $notificationSender
     *
     * @return Response
     */
    public function test(NotificationSender $notificationSender): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(['name' => 'Demo']);

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

    /**
     * @Route("/read/{notification}", name="mark_read")
     * @ParamConverter("notification", class=Notification::class)
     */
    public function read(Notification $notification): Response
    {
        $notification->setReadAt(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($notification);
        $em->flush();

        return $this->redirectToRoute('demo');
    }
}
