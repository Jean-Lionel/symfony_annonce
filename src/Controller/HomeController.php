<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    

   
    /**
     * @Route("/", name="app_home")
     */
    public function index(AnnonceRepository $annonce): Response
    {
        $annonces = $annonce->findBy([], [
            "createdAt" => "DESC"
        ]);

        $lastAnnonce = $annonces[0];
        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'annonces' => $annonces,
            'lastAnnonce' => $lastAnnonce ,
        ]);
    }

    
    /**
     * @Route("det/{id}", name="app_home_show", methods={"GET"})
     */

    public function show(Annonce $annonce): Response
    {
        return $this->render('home/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }
}
