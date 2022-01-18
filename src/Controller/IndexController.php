<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\DayRepository;

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
    public function tarifs(DayRepository $drep): Response
    {
        $r = $this->render('index/tarifs.html.twig', [
            'days'=> $drep->getAll()
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
