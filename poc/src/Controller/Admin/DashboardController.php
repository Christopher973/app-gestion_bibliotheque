<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Adherent;
use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Emprunt;
use App\Entity\Livre;
use App\Entity\Reservations;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Annotation\IsGranted;
use Symfony\Component\Security\Http\Attribute\IsGranted as AttributeIsGranted;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function adminIndex(EntityManagerInterface $entityManager): Response
    {
        $livreRepo = $entityManager->getRepository(Livre::class);
        $adherentRepo = $entityManager->getRepository(Adherent::class);
        $empruntRepo = $entityManager->getRepository(Emprunt::class);
        $totalL = $livreRepo->count([]);
        $totalA = $adherentRepo->count([]); 
        $totalE = $empruntRepo->count([]);

        $dernierE = $empruntRepo->findBy([], ['dateEmprunt' => 'DESC'], 5);

        return $this->render('admin/dashboard.html.twig', [
            'totalLivres' => $totalL,
            'totalAdherents' => $totalA,
            'totalEmprunts' => $totalE,
            'dernierEmprunts' => $dernierE
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Poc Bibliotheque');
    }

    public function configureMenuItems(): iterable
    {
        $user = $this->getUser();


        if ($user !== null && (in_array('ROLE_SUPER_ADMIN', $user->getRoles(), true) || in_array('ROLE_ADMIN', $user->getRoles(), true))) {
            // Groupe pour le tableau de bord
            yield MenuItem::section('Tableau de bord');
            yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        }
        if ($user && in_array('ROLE_SUPER_ADMIN', $user->getRoles(), true)) {
            // Groupe pour les fonctionnalités principales
            yield MenuItem::section('Gestion des ressources');
            yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', AdherentCrudController::getEntityFqcn());
            yield MenuItem::linkToCrud('Auteur', 'fas fa-pencil-alt', AuteurCrudController::getEntityFqcn());
            yield MenuItem::linkToCrud('Livre', 'fas fa-book', LivreCrudController::getEntityFqcn());
            yield MenuItem::linkToCrud('Categorie', 'fas fa-tags', CategorieCrudController::getEntityFqcn());
        }
if ($user !== null && (in_array('ROLE_SUPER_ADMIN', $user->getRoles(), true) || in_array('ROLE_ADMIN', $user->getRoles(), true))) {
            // Groupe pour le tableau de bord
            yield MenuItem::section('Gestion des emprunts et réservations');
            yield MenuItem::linkToCrud('Emprunts', 'fas fa-exchange-alt', EmpruntCrudController::getEntityFqcn());
            yield MenuItem::linkToCrud('Réservations', 'fas fa-calendar-alt', ReservationsCrudController::getEntityFqcn());
        }
    }
}