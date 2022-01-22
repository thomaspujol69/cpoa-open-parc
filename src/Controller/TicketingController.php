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
use App\Repository\PromoCodeRepository;
use App\Form\TicketReservationType;
use Doctrine\ORM\EntityManagerInterface;


class TicketingController extends AbstractController
{
    use TargetPathTrait;
    
    #[Route('/billetterie', name: 'ticketing')]
    public function index(Request $request, DayRepository $drep): Response
    {
        $user = $this->getUser();
        if (!$user){
            $this->saveTargetPath($request->getSession(), "main", $request->getUri());
            return $this->redirectToRoute('app_login');
        }
        $days = $drep->getAll();
        return $this->render('ticketing/index.html.twig', [
            'days' => $days
        ]);
    }

    #[Route('/billetterie/{date}', name: 'selectTicket', methods: ['get'])]
    public function selectTicket(Request $request, $date, DayRepository $drep, TicketRepository $trep, TicketTypeRepository $ttrep): Response
    {
        $user = $this->getUser();
        if (!$user){
            $this->saveTargetPath($request->getSession(), "main", $request->getUri());
            return $this->redirectToRoute('app_login');
        }
        $day = $drep->findOneByDate($date);
        $ticket = new \App\Entity\Ticket();
        $form = $this->createForm(TicketReservationType::class, $ticket);

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
    #[Route('/billetterie/{date}', name: 'buyTicket', methods: ['post'])]
    public function buyTicket(Request $request, $date, DayRepository $drep, TicketRepository $trep, PromoCodeRepository $pcrep, TicketTypeRepository $ttrep): Response
    {
        $user = $this->getUser();
        if (!$user){
            $this->saveTargetPath($request->getSession(), "main", $request->getUri());
            return $this->redirectToRoute('app_login');
        }
        $day = $drep->findOneByDate($date);

        $qt = (isset($_POST["ticket_reservation"]["quantity"])) ? $_POST["ticket_reservation"]["quantity"] : "";
        $promoCode = (isset($_POST["ticket_reservation"]["promoCode"])) ? $_POST["ticket_reservation"]["promoCode"] : "";
        $is1Cat = (isset($_POST["ticket_reservation"]["ticketType"])) ? $_POST["ticket_reservation"]["ticketType"] : 0;
        //print_r([$qt, $promoCode, $is1Cat]);

        if ($is1Cat == 1){
            $c = $ttrep->findByLabel("Catégorie 1");
            $nbDispoPlaces = $day->getCat1DispPl() - $trep->countByTicketType($c);
            $cp = $day->getCat1Price();
        }else{
            $c = $ttrep->findByLabel("Catégorie 2");
            $nbDispoPlaces = $day->getCat2DispPl() - $trep->countByTicketType($c);
            $cp = $day->getCat2Price();
        }

        $pc = $pcrep->findByLabel($promoCode);

        if($pc!=null){
            // Il faut appliquer le promo code
            
            $prct = $pc[0]->getTicketType(); // On prend le 1er car unique
            if ($prct!=null){
                $prct = $prct->getPricePercentage();
                if($prct!=null && is_numeric($prct) && $prct<200 && $prct>0){
                    $cp=$cp*$prct/100;
                }
            }
        }

        return $this->render('ticketing/book.html.twig', [
            'day' => $day,
            'quantity' => $qt,
            'ppp' => $cp,
            'total' => $cp*$qt,
            'promoCode' => $_POST["ticket_reservation"]["promoCode"],
            'ticketType' => (isset($_POST["ticket_reservation"]["ticketType"])) ? $_POST["ticket_reservation"]["ticketType"] : 0
        ]);
    }

    
    #[Route('/billetterie/{date}/reserver', name: 'reserveTicket', methods: ['post'])]
    public function reserveTicket(Request $request, $date, EntityManagerInterface $entityManager, DayRepository $drep, TicketRepository $trep, PromoCodeRepository $pcrep, TicketTypeRepository $ttrep): Response
    {
        $user = $this->getUser();
        if (!$user){
            $this->saveTargetPath($request->getSession(), "main", $request->getUri());
            return $this->redirectToRoute('app_login');
        }
        $day = $drep->findOneByDate($date);

        $qt = (isset($_POST["quantity"])) ? $_POST["quantity"] : "";
        if($qt=="" || !is_numeric($qt) || $qt<1){
            return $this->redirectToRoute('selectTicket', ['date' => $date]);
        }
        $promoCode = (isset($_POST["promoCode"])) ? $_POST["promoCode"] : "";
        $is1Cat = (isset($_POST["ticketType"])) ? $_POST["ticketType"] : 0;
        
        if ($is1Cat == 1){
            $c = $ttrep->findByLabel("Catégorie 1");
            $nbDispoPlaces = $day->getCat1DispPl() - $trep->countByTicketType($c);
            $cp = $day->getCat1Price();
        }else{
            $c = $ttrep->findByLabel("Catégorie 2");
            $nbDispoPlaces = $day->getCat2DispPl() - $trep->countByTicketType($c);
            $cp = $day->getCat2Price();
        }

        $pc = $pcrep->findByLabel($promoCode);
        $prct=null;
        if($pc!=null){
            // Il faut appliquer le promo code
            // Fichier des licences à ajouter ici
            $prct = $pc[0]->getTicketType(); // On prend le 1er car unique
            if ($prct!=null){
                $prct = $prct->getPricePercentage();
                if($prct!=null && is_numeric($prct) && $prct<200 && $prct>0){
                    $cp=$cp*$prct/100;
                }
            }
        }
        //Enregistrement en BDD
        for ($i=0; $i<$qt; $i++){
            $t = new \App\Entity\Ticket();
            $t->setDay($day);
            $t->setUser($user);
            if ($prct!=null){
                $t->setTicketType($prct);
            }
            if($pc!=null){
                $t->setPromoCode($pc[0]);
            }
            //print($t);
            $entityManager->persist($t);
        }
        
        $entityManager->flush();

        return $this->render('ticketing/bookingConfirmation.html.twig', [
            'day' => $day,
            'quantity' => $qt,
            'ppp' => $cp,
            'total' => $cp*$qt
        ]);
    }
}
