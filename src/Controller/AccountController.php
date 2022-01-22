<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TicketRepository;

class AccountController extends AbstractController
{
    #[Route('/compte', name: 'account')]
    public function index(TicketRepository $trep): Response
    {
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('index_app');
        }
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
            'tickets' => $trep->findByUser($user)
        ]);
    }
}
