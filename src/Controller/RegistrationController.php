<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'security.registration')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        TokenGeneratorInterface $tokenGeneratorInterface,
        SendMailService $mail,
        UserRepository $userRepository
    ): Response {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profilePicture = $form->get('profilePicture')->getData();
            if (empty($profilePicture)) {
                $user->setProfilePicture('default.png');
            }

            $newprofilePicture = uniqid().'.'.$profilePicture->guessExtension();

            try {
                $profilePicture->move(
                    $this->getParameter('uploads_directory'),
                    $newprofilePicture
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                $this->addFlash(
                    'warning',
                    'A problem occurred during the download !'
                );
            }
            $user->setProfilePicture($newprofilePicture);

            $tokenRegistration = $tokenGeneratorInterface->generateToken();

            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setTokenRegistration($tokenRegistration);

            $entityManager->persist($user);
            $entityManager->flush();

            $userRepository->add($user, true);

            $mail->send(
                'no-reply@snowtricks.com',
                $user->getEmail(),
                'Activating your account on the Snowtricks website',
                'confirmation_email',
                [
                    'user' => $user,
                    'token' => $tokenRegistration,
                    'lifetimeToken' => $user->getTokenRegistrationLifetime()->format('d-m-Y à H\hi'),
                ]
            );

            $this->addFlash('emailRegistration', true);

            return $this->redirectToRoute('home.index');
        }

        return $this->render('pages/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/emailVerify/{token}/{id}', name: 'email_verify', methods: ['GET'])]
    public function emailVerify(
        string $token,
        User $user,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager
    ): Response {
        if ($user->getTokenRegistration() !== $token) {
            throw new \LogicException();
        }

        if (null === $user->getTokenRegistration()) {
            throw new \LogicException();
        }

        if (new \DateTime('now') > $user->getTokenRegistrationLifetime()) {
            $userId = $userRepository->findOneBy(['id' => $user->getId()]);
            $userRepository->remove($userId, true);

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
