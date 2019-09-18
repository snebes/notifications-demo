<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Notification\DemoBothNotification;
use App\Notification\DemoDatabaseNotification;
use App\Notification\DemoMailNotification;
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
     * @return Response
     */
    public function test(): Response
    {
        $user = $this->getDemoUser();

        return $this->render('base.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/both", name="demo_both")
     *
     * @param NotificationSender $notificationSender
     *
     * @return Response
     */
    public function sendBoth(NotificationSender $notificationSender): Response
    {
        $notification = new DemoBothNotification();
        $notificationSender->send($this->getDemoUser(), $notification);

        return $this->redirectToRoute('demo');
    }

    /**
     * @Route("/mail", name="demo_mail")
     *
     * @param NotificationSender $notificationSender
     *
     * @return Response
     */
    public function sendMail(NotificationSender $notificationSender): Response
    {
        $notification = new DemoMailNotification();
        $notificationSender->send($this->getDemoUser(), $notification);

        return $this->redirectToRoute('demo');
    }

    /**
     * @Route("/db", name="demo_db")
     *
     * @param NotificationSender $notificationSender
     *
     * @return Response
     */
    public function sendDb(NotificationSender $notificationSender): Response
    {
        $notification = new DemoDatabaseNotification();
        $notificationSender->send($this->getDemoUser(), $notification);

        return $this->redirectToRoute('demo');
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

    private function getDemoUser(): User
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(['name' => 'Demo']);

        if (null === $user) {
            $user = new User();
            $em->persist($user);
            $em->flush();
        }

        return $user;
    }
}
