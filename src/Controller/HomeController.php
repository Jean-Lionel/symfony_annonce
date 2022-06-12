<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
class HomeController extends AbstractController
{
       
    /**
     * @Route("/", name="app_home")
     */
    public function index(AnnonceRepository $annonce, CategoryRepository $cat, Request $request): Response
    {
        $category_id = $request->query->get('categorie_id');
        $searchKey = $request->query->get('keyword');

        $annonces = $annonce->findBy([
            'title'
        ], [
            "createdAt" => "DESC"
        ]);

        $lastAnnonce = $annonces[0] ?? new Annonce();
        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'annonces' => $annonces,
            'lastAnnonce' => $lastAnnonce ,
            'categories' => $cat->findAll()
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
