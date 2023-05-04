<?php

namespace App\Security;

use App\Entity\User as AppUser;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;

class UserChecker extends AbstractController implements UserCheckerInterface
{
    
    public function checkPreAuth(UserInterface $user): void
    {
        if(!$user instanceof AppUser) {
                
            return;
        } 
    }
    
    public function checkPostAuth(UserInterface $user): void
    {
        if(!$user instanceof AppUser) {
                
            return;
        }

        if(!$user->isVerified()){
            throw new CustomUserMessageAccountStatusException("Your account is not activated, 
            please confirm it before {$user->getTokenRegistrationLifetime()->format('d-m-Y à H\hi')}, after this date your account will be deleted !");
        }

        $this->addFlash(
            'connected',
            true
        );
    }
}