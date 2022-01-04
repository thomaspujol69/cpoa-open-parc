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
        $r = $this->render('index/index.html.twig', [
            
        ]);

        return $r;
    }
}
