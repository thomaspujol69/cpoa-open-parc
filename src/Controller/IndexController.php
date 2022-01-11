<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

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
            'tarifsGP'=> [
                'jour1' => ['jour' => 'Dimanche', 'cat1' => '30,00€', 'cat2' => '25,00€'],
                'jour2' => ['jour' => 'Lundi', 'cat1' => '30,00€', 'cat2' => '25,00€'],
                'jour3' => ['jour' => 'Mardi', 'cat1' => '30,00€', 'cat2' => '25,00€'],
                'jour4' => ['jour' => 'Mercredi', 'cat1' => '40,00€', 'cat2' => '30,00€'],
                'jour5' => ['jour' => 'Jeudi', 'cat1' => '45,00€', 'cat2' => '35,00€'],
                'jour6' => ['jour' => 'Vendredi', 'cat1' => '60,00€', 'cat2' => '48,00€'],
                'jour7' => ['jour' => 'Samedi', 'cat1' => '60,00€', 'cat2' => '45,00€'],
            ],

            'tarifsL'=> [
                'jour1' => ['jour' => 'Dimanche', 'cat1' => '25,00€', 'cat2' => '20,00€'],
                'jour2' => ['jour' => 'Lundi', 'cat1' => '25,00€', 'cat2' => '20,00€'],
                'jour3' => ['jour' => 'Mardi', 'cat1' => '25,00€', 'cat2' => '20,00€'],
                'jour4' => ['jour' => 'Mercredi', 'cat1' => '35,00€', 'cat2' => '25,00€'],
                'jour5' => ['jour' => 'Jeudi', 'cat1' => '39,00€', 'cat2' => '30,00€'],
                'jour6' => ['jour' => 'Vendredi', 'cat1' => '50,00€', 'cat2' => '38,00€'],
                'jour7' => ['jour' => 'Samedi', 'cat1' => '50,00€', 'cat2' => '38,00€'],
            ]
        ]);

        return $r;
    }
    #[Route('/gen/{e}', name: 'gen')]
    public function gen($e, ManagerRegistry $doctrine): Response{
        $em = $doctrine->getManager();
        $i = 0;
        $entities = $em->getRepository('App:'.$e)->findAll();
        $code = ""; 
        
        foreach($entities as $entity)
        {
            $cols = $em->getClassMetadata(get_class($entity))->getColumnNames();
            $code .= "\$i$i = new \\App\\Entity\\".$e."();<br>";
            foreach ($cols as $key => $value) {
                //$code .= "$value";
                $g = 'get'.str_replace(" ", "", ucwords(str_replace("_", " ", $value)));
                if ($g!="getId"){
                    $code .= '$i'.$i."->set".str_replace(" ", "", ucwords(str_replace("_", " ", $value)))."('" . str_replace("'", "\'", $entity->$g()) . "'); <br> ";
                }
            }
            $code .= '$manager->persist('."\$i$i".');<br><br>';
            $i++;
        }
        $code .= "\$manager->flush();<br>";
        return new Response($code);
    }
}
