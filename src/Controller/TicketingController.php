<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use App\Repository\DayRepository;
use App\Form\TicketReservationType;

class TicketingController extends AbstractController
{
    use TargetPathTrait;
    
    #[Route('/billetterie', name: 'ticketing')]
    public function index(Request $request, DayRepository $drep): Response
    {
        $user = $this->getUser();
        //print_r($user);
        if (!$user){
            $this->saveTargetPath($request->getSession(), "main", $request->getUri());
            return $this->redirectToRoute('app_login');//, array('_target_path' => 'ticketing'));
        }
        $days = $drep->getAll();
        return $this->render('ticketing/index.html.twig', [
            'days' => $days
        ]);
    }

    #[Route('/billetterie/{date}', name: 'selectTicket')]
    public function selectTicket(Request $request, $date, DayRepository $drep): Response
    {
        $day = $drep->findOneByDate($date);
        $ticket = new \App\Entity\Ticket();
        $form = $this->createForm(TicketReservationType::class, $ticket);
        if ($form->isSubmitted() && $form->isValid()) {
            
        }
        $nbDispoPlaces = 1;
        $ppp = 1;
        return $this->render('ticketing/day.html.twig', [
            'form' => $form->createView(),
            'nbDispoPlaces' => $nbDispoPlaces,
            'ppp1' => $day->getCat1Price(),
            'ppp2' => $day->getCat2Price()
        ]);
    }
}
