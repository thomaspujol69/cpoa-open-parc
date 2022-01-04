<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketingController extends AbstractController
{
    #[Route('/billetterie', name: 'ticketing')]
    public function index(): Response
    {
        $user = $this->getUser();
        print_r($user);
        if (!$user){
            return $this->redirectToRoute('app_login', array('_target_path' => 'ticketing'));
        }
        
        return $this->render('ticketing/index.html.twig', [
            'controller_name' => 'TicketingController',
        ]);
    }
}
