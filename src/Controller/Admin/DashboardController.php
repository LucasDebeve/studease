<?php

namespace App\Controller\Admin;

use App\Entity\Candidature;
use App\Entity\Ecole;
use App\Entity\Formation;
use App\Entity\InsertionProfessionnelle;
use App\Entity\Localisation;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfony Studease');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Ecole', 'fas fa-list', Ecole::class);
        yield MenuItem::linkToCrud('Formation', 'fas fa-list', Formation::class);
        yield MenuItem::linkToCrud('Insertion Professionnelle', 'fas fa-list', InsertionProfessionnelle::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Localisation', 'fas fa-list', Localisation::class);
        yield MenuItem::linkToCrud('Candidature', 'fas fa-list', Candidature::class);

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()->addCssFile('https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,300,0,0');
    }
}
