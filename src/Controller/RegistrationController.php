<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            switch ($form->get('tpUser')->getData()) {
                case 1:
                    $user->setRoles(['ROLE_STUDENT']);
                    break;
                case 2:
                    $user->setRoles(['ROLE_COMPANY']);
                    break;
                default:
                    $user->setRoles(['ROLE_USER']);
            }

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/profile/{id}', name: 'app_profile')]
    public function profile(
        #[MapEntity(expr: 'repository.findWithFormationAndEcole(id)')]
        User $id): Response
    {
        return $this->render('registration/profile.html.twig', [
            'user' => $id,
        ]);
    }

    #[Route('/profile', name: 'app_user_profile')]
    #[isGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function self_profile(): Response
    {
        $user = $this->getUser();

        return $this->redirectToRoute('app_profile', ['id' => $user->getId()]);
    }
}
