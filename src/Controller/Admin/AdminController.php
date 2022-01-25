<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Entity\Arbitrator;
use App\Entity\BallBoy;
use App\Entity\Booking;
use App\Entity\Court;
use App\Entity\Player;
use App\Entity\Team;
use App\Entity\User;
use App\Entity\Game;
use App\Entity\PromoCode;
use App\Entity\Ticket;
use App\Entity\TicketType;
use App\Entity\Day;
use App\Entity\BallBoysTeam;


class AdminController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */

    
    public function index(): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        // or add an optional message - seen by developers
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        return $this->render('admin/index.html.twig');
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Open Parcdmin');
    }

    public function configureMenuItems(): iterable
    {
        return[
            MenuItem::linktoRoute('Retourner au site', 'fas fa-home', 'index'),
            MenuItem::section('Tennis'),
            MenuItem::linkToCrud('Arbitres', 'fas fa-flag', Arbitrator::class),
            MenuItem::linkToCrud('Ramasseurs de Balles', 'fas fa-baseball-ball', BallBoy::class),
            MenuItem::linkToCrud('Équipes de Ramasseurs de Balles', 'fas fa-user-friends', BallBoysTeam::class),
            MenuItem::linkToCrud('Réservations', 'fas fa-book', Booking::class),
            MenuItem::linkToCrud('Terrains', 'far fa-map', Court::class),
            MenuItem::linkToCrud('Joueurs', 'fas fa-running', Player::class),
            MenuItem::linkToCrud('Équipes', 'fas fa-users', Team::class),
            MenuItem::linkToCrud('Matchs', 'fas fa-trophy', Game::class),
            MenuItem::linkToCrud('Jours', 'fas fa-users', Day::class),
            MenuItem::section('Reservation'),
            MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class),
            MenuItem::linkToCrud('Tickets', 'fas fa-ticket-alt', Ticket::class),
            MenuItem::linkToCrud('Types de Tickets', 'fas fa-clipboard-list', TicketType::class),
            MenuItem::linkToCrud('Codes Promo', 'fas fa-percentage', PromoCode::class)
        ];
    }
}
