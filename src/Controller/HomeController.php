<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/api/data', name: 'api_data')]
    public function apiData(): JsonResponse
    {
        $data = ['message' => 'Hello from Symfony API!'];

        return $this->json($data);
    }

    #[Route('/cgu', name: 'app_cgu')]
    public function cgu(): Response
    {
        return $this->render('home/cgu.html.twig');
    }

    #[Route('/mentions-legales', name: 'app_legals')]
    public function legals(): Response
    {
        return $this->render('home/legals.html.twig', ['mail' => 'mama@studease.fr', 'adresse' => 'avenue du CNIL']);
    }
}
