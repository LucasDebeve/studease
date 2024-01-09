<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\VerifyUserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
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

    #[Route('/profile/{id}/update', name: 'app_profile_update')]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function update(EntityManagerInterface $entityManager,
        #[MapEntity(expr: 'repository.findWithFormationAndEcole(id)')]
        User $id,
        Request $request)
    {
        // Verify if the user is the same as the one in the URL
        if ($this->getUser()->getId() !== $id->getId()) {
            return $this->redirectToRoute('app_profile', ['id' => $this->getUser()->getId()]);
        }
        $form = $this->createForm(UserType::class, $id);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $avatar = $form->get('avatar')->getData();
            $password = $form->get('password')->getData();
            $cv = $form->get('cv')->getData();

            if ($avatar) {
                $new_filename = uniqid().'.'.$avatar->guessExtension();

                try {
                    $avatar->move(
                        $this->getParameter('avatar_directory'),
                        $new_filename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors de l\'upload de l\'avatar');
                }

                $user->setAvatar(file_get_contents($this->getParameter('avatar_directory').'/'.$new_filename));
            }
            if ($password) {
                $user->setPassword($this->hasher->hashPassword($user, $password));
            }
            if ($cv) {
                $new_filename = uniqid().'.'.$cv->guessExtension();
                try {
                    $cv->move($this->getParameter('cv_directory'), $new_filename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors de l\'upload du CV');
                }
                $user->setCv($new_filename);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_profile', ['id' => $user->getId()]);
        }

        return $this->render('registration/update.html.twig', ['user' => $id, 'form' => $form]);
    }

    #[Route('/dashboard/unVerified', name: 'app_dashboard_unverified')]
    #[IsGranted('ROLE_ADMIN')]
    public function consultUnVerifiedUsers(UserRepository $repository): Response
    {
        $users = $repository->findUnverifiedUsers();

        return $this->render('security/unverifiedUsers.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/dashboard/unVerified/{id}', name: 'app_dashboard_verify')]
    #[IsGranted('ROLE_ADMIN')]
    public function verifyUser(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VerifyUserFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('confirm')->isClicked()) {
                $user->setIsVerified(true);
                $entityManager->flush();
                $this->addFlash('success', 'Utilisateur confirmé');
            } else {
                $entityManager->remove($user);
                $entityManager->flush();
                $this->addFlash('success', 'Utilisateur supprimé');
            }

            return $this->redirectToRoute('app_dashboard_unverified');
        }

        return $this->render('security/verifyForm.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
