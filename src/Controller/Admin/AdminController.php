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


class AdminController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */

    
    public function index(): Response
    {
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
            MenuItem::linkToCrud('Arbitrators', 'fas fa-users', Arbitrator::class),
            MenuItem::linkToCrud('Ballboys', 'fas fa-users', BallBoy::class),
            MenuItem::linkToCrud('Bookings', 'fas fa-users', Booking::class),
            MenuItem::linkToCrud('Courts', 'fas fa-users', Court::class),
            MenuItem::linkToCrud('Players', 'fas fa-users', Player::class),
            MenuItem::linkToCrud('Teams', 'fas fa-users', Team::class),
            MenuItem::linkToCrud('Users', 'fas fa-users', User::class)
        ];
    }
}
