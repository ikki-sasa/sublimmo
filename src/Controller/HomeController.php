<?php

namespace App\Controller;

use App\Repository\CommercialRepository;
use App\Repository\MaisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// va nous permettre de nous connecter a la bdd 
class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    // une route est comper d'un fichier et d'un nom 
    public function index(MaisonRepository $maisonRepository, CommercialRepository $commercialRepository): Response
    {
        // method de base qu'on utilise cf au dossier src repository file MaisonRepository.php
        //$houses = $maisonRepository->findAll(); //trouve toutes les maisons
        // $houses = $maisonRepository->findBy([], ['id' => 'DESC'], 6);


        $houses = $maisonRepository->findLastSix(); // avec query bulder

        $commercials = $commercialRepository->findAll(); //trouver toutes les maisons 

        return $this->render('home/index.html.twig', [
            // maisons sera utiliser dans la page index.html.twig 
            'maisons' => $houses,
            // $houses est un array qui contient toutes les maisons de la bdd sous forme d'objet une "collection"
            'commerciaux' => $commercials
        ]);

        //[
        //'controller_name' => 'HomeController', pas nécessaire
        // tableau d'information qu'on donne à la vue 
        //]
    }
}
