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
        $liste = array('pizzas','Ana','spaghettis carbo','pâtes au saumon','blanquette de veau','escalope de dinde à la crème et aux champignons','Thomas','raclette');
        return $this->render('index/index.html.twig', [
            'controller_name' => 'Banane',
            'liste' => $liste[array_Rand($liste)],
        ]);
    }
}
