<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class TicketingController extends AbstractController
{
    use TargetPathTrait;
    
    #[Route('/billetterie', name: 'ticketing')]
    public function index(Request $request): Response
    {
        $user = $this->getUser();
        //print_r($user);
        if (!$user){
            $this->saveTargetPath($request->getSession(), "main", $request->getUri());
            return $this->redirectToRoute('app_login');//, array('_target_path' => 'ticketing'));
        }
        $days = [[
                'name' => "Dimanche",
                'date' => "15 Mai 2022 - 10h00",
                'description' => "Organisateur : ALLIN EVENT"
            ],
            [
                'name' => "Lundi",
                'date' => "16 Mai 2022 - 10h00",
                'description' => "Organisateur : ALLIN EVENT"
            ],
            [
                'name' => "Mardi",
                'date' => "17 Mai 2022 - 10h00",
                'description' => "Organisateur : ALLIN EVENT"
            ],
            [
                'name' => "Mercredi",
                'date' => "18 Mai 2022 - 10h00",
                'description' => "Organisateur : ALLIN EVENT"
            ],
            [
                'name' => "Jeudi",
                'date' => "19 Mai 2022 - 11h00",
                'description' => "Organisateur : ALLIN EVENT"
            ],
            [
                'name' => "Vendredi",
                'date' => "20 Mai 2022 - 12h30",
                'description' => "Organisateur : ALLIN EVENT"
            ],
            [
                'name' => "Samedi",
                'date' => "21 Mai 2022 - 12h15",
                'description' => "Organisateur : ALLIN EVENT"
            ]];
        return $this->render('ticketing/index.html.twig', [
            'days' => $days
        ]);
    }

    #[Route('/billetterie/{date}', name: 'selectTicket')]
    public function selectTicket(DateTime $date): Response
    {

    }
}
