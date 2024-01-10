<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthenticator $authenticator, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $errors_password = $validator->validate($form->get('plainPassword')->getData(), [
            new Length(['min' => 6]),
            new NotBlank(),
        ]);
        $parameters = [
            'registrationForm' => $form->createView(), ];
        $errors_email = $validator->validate($user);
        if (0 == count($errors_password) && 0 == count($errors_email)) {
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
                $user->setIsVerified(false);

                $entityManager->persist($user);
                $entityManager->flush();
                // do anything else you need here, like send an email

                return $userAuthenticator->authenticateUser(
                    $user,
                    $authenticator,
                    $request
                );
            }
        } else {
            if (0 < count($errors_email)) {
                $errors_email = $errors_email->get(0);
                $parameters['errors_email'] = $errors_email;
            }
            if (0 < count($errors_password)) {
                $errors_password = $errors_password->get(0);
                $parameters['errors_password'] = $errors_password;
            }
        }

        return $this->render('registration/register.html.twig', $parameters);
    }
}
