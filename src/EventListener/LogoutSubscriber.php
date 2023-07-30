<?php

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class LogoutSubscriber extends AbstractController implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [LogoutEvent::class => 'onLogout'];
    }

    public function onLogout(): void
    {
        $this->addFlash(
            'logout',
            true
        );
    }
}
