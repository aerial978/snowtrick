<?php

namespace App\Controller;

use DateTime;
use LogicException;
use App\Entity\User;
use App\Service\SendMailService;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'security.registration')]
    public function register(
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        EntityManagerInterface $entityManager,
        TokenGeneratorInterface $tokenGeneratorInterface,
        SendMailService $mail): Response
    {
        $user = new User();
        $user->setRoles(["ROLE_USER"]);
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tokenRegistration = $tokenGeneratorInterface->generateToken();

            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setTokenRegistration($tokenRegistration);
            $user->setFile('default.png');

            $entityManager->persist($user);
            $entityManager->flush();

            $mail->send(
                'no-reply@snowtricks.com',
                $user->getEmail(),
                'Activating your account on the Snowtricks website',
                'confirmation_email',
                [
                    'user' => $user,
                    'token' => $tokenRegistration,
                    'lifetimeToken' => $user->getTokenRegistrationLifetime()->format('d-m-Y à H\hi')
                ]
            );

            $this->addFlash('emailRegistration', true);

            return $this->redirectToRoute('home.index');
        }
        
        return $this->render('pages/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);    
    }

    #[Route('/emailVerify/{token}/{id}', name: "email_verify", methods: ['GET'])]
    public function emailVerify(
        string $token, 
        User $user,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager): Response
    {
        if($user->getTokenRegistration() !== $token) {
            throw new LogicException();
        }

        if($user->getTokenRegistration() === null){
            throw new LogicException();
        }

        if(new DateTime('now') > $user->getTokenRegistrationLifetime()){
            $userId = $userRepository->findOneBy(['id'=>$user->getId()]);
            $userRepository->remove($userId,true);

            $this->addFlash(
                'warning',
                ' Your account activation link is no longer valid, please register again !'
            );

            return $this->redirectToRoute('security.registration');
        }

        $user->setIsVerified(true);
        $user->setTokenRegistration(null);
        $user->setTokenRegistrationLifetime(null);

        $entityManager->flush();

        $this->addFlash('emailVerify', true);

        return $this->redirectToRoute('security.login');
    }
}