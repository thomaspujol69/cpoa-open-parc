<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $r = $this->render('index/index.html.twig', [
            
        ]);

        return $r;
    }

    #[Route('/tarifs', name: 'tarifs')]
    public function tarifs(): Response
    {
        $r = $this->render('index/tarifs.html.twig', [
            'tarifs'=> [
                'jour1' => ['jour' => 'Dimanche', 'cat1' => '30,00€', 'cat2' => '25,00€'],
                'jour2' => ['jour' => 'Lundi', 'cat1' => '30,00€', 'cat2' => '25,00€'],
                'jour3' => ['jour' => 'Mardi', 'cat1' => '30,00€', 'cat2' => '25,00€'],
                'jour4' => ['jour' => 'Mercredi', 'cat1' => '40,00€', 'cat2' => '30,00€'],
                'jour5' => ['jour' => 'Jeudi', 'cat1' => '45,00€', 'cat2' => '35,00€'],
                'jour6' => ['jour' => 'Vendredi', 'cat1' => '60,00€', 'cat2' => '48,00€'],
                'jour7' => ['jour' => 'Samedi', 'cat1' => '60,00€', 'cat2' => '45,00€'],
            ]
        ]);

        return $r;
    }
}
