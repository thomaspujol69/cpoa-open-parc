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


class AdminController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */

    
    public function index(): Response
    {
         $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
            // or add an optional message - seen by developers
            $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        
        return parent::index();
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Open Parcdmin');
    }

    public function configureMenuItems(): iterable
    {
        return[
            MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'index'),
            MenuItem::linkToCrud('Arbitrators', 'fas fa-flag', Arbitrator::class),
            MenuItem::linkToCrud('Ballboys', 'fas fa-baseball-ball', BallBoy::class),
            MenuItem::linkToCrud('Bookings', 'fas fa-book', Booking::class),
            MenuItem::linkToCrud('Courts', 'far fa-map', Court::class),
            MenuItem::linkToCrud('Players', 'fas fa-running', Player::class),
            MenuItem::linkToCrud('Teams', 'fas fa-users', Team::class),
            MenuItem::linkToCrud('Users', 'fas fa-user', User::class),
            MenuItem::linkToCrud('Games', 'fas fa-baseball-ball', Game::class),
            MenuItem::linkToCrud('Tickets', 'fas fa-baseball-ball', Ticket::class),
            MenuItem::linkToCrud('Ticket Types', 'fas fa-baseball-ball', TicketType::class),
            MenuItem::linkToCrud('Promo Codes', 'fas fa-baseball-ball', PromoCode::class)
        ];
    }
}
