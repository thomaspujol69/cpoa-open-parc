<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use App\Repository\DayRepository;
use App\Repository\TicketRepository;
use App\Repository\TicketTypeRepository;
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
    public function selectTicket(Request $request, $date, DayRepository $drep, TicketRepository $trep, TicketTypeRepository $ttrep): Response
    {
        $day = $drep->findOneByDate($date);
        $ticket = new \App\Entity\Ticket();
        $form = $this->createForm(TicketReservationType::class, $ticket);
        if ($form->isSubmitted() && $form->isValid()) {
            print_r($form);
        }
        $c1 = $ttrep->findByLabel("Catégorie 1");
        $c2 = $ttrep->findByLabel("Catégorie 2");

        // Le nombre de places par catégories moins le nombre de places réservées
        $nbDispoPlaces1 = $day->getCat1DispPl() - $trep->countByTicketType($c1);
        $nbDispoPlaces2 = $day->getCat2DispPl() - $trep->countByTicketType($c2);

        return $this->render('ticketing/day.html.twig', [
            'form' => $form->createView(),
            'day' => $day,
            'nbDispoPlaces1' => $nbDispoPlaces1,
            'nbDispoPlaces2' => $nbDispoPlaces2,
            'ppp1' => $day->getCat1Price(),
            'ppp2' => $day->getCat2Price()
        ]);
    }
}
