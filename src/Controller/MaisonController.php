<?php

namespace App\Controller;

use App\Entity\Maison;
use App\Form\MaisonType;
use App\Repository\MaisonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MaisonController extends AbstractController
{
    #[Route('/maisons', name: 'maison_index')] // ce qui est afficher dans l'url
    public function index(MaisonRepository $maisonRepository): Response
    {
        $houses = $maisonRepository->findAll();
        return $this->render('maison/index.html.twig', [
            'maisons' => $houses,
        ]);
    }

    #[Route('/maison/{id}', name: 'maison_show')]
    public function show(MaisonRepository $maisonRepository, int $id): Response
    {
        // $maison = $maisonRepository->find($id);
        return $this->render('maison/show.html.twig', [
            // 'maison' => $house
            'maison' => $maisonRepository->find($id)
        ]);
    }

    #[Route('/admin/maisons', name: 'admin_maison_index')]
    public function adminIndex(MaisonRepository $maisonRepository): Response
    {
        $houses = $maisonRepository->findAll();
        return $this->render('admin/maisons.html.twig',  [
            'maisons' => $houses
            // => association key value
            // 'maisons' => $maisonRepository->findAll(); autre façon de l'écrire
        ]);
    }

    #[Route('/admin/maison/create', name: 'maison_create')]
    public function create(Request $request, ManagerRegistry $managerRegistry)
    {
        $maison = new Maison(); //création d'une nouvelle maison
        $form = $this->createForm(MaisonType::class, $maison);
        //création d'un formulaire avec en paramètre la nouvelle maison 
        $form->handleRequest($request); //gestionnaire de requêtes HTTP symfony puisse detecter l'envoi du form 

        // vérifier si le formulaire a été envoyé et sest valide 
        /**
         * ici il faut gérer l'image
         * récupération les infos du form
         * renommer l'img
         * upload
         * setImg()
         * Idem  pour img2
         * 
         * envoi vers la bdd
         * message de succes
         * redirection
         * 
         */
        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg1 = $form['img1']->getData(); //récup de l'img
            $extensionImg1 = $infoImg1->guessExtension(); // récupère l'extension de l'image1
            $nomImg1 = time() . '-1.' . $extensionImg1; //créer un nom unique pour l'image
            $infoImg1->move($this->getParameter('dossier_photos_maisons'), $nomImg1);
            //$infoImg1->move('../../public/img/maisons/', $nomImg1);
            // déplace l'image dans le bond dossier crééer un parametre global que je pourrais appeller de n'importe où il faut aller sur le fichier services.yaml puis rentrer les infos du chemin dans paramètre puis créer un fichier dans public->img créer maison
            $maison->setImg1($nomImg1); // définit le nom de l'image a mettre en bdd

            $infoImg2 = $form['img2']->getData();
            if ($infoImg2 !== null) {
                $extensionImg2 = $infoImg2->guessExtension();
                $nomImg2 = time() . '-2.' . $extensionImg2;
                $infoImg2->move($this->getParameter('dossier_photos_maisons'), $nomImg2);
                $maison->setImg2($nomImg2);
            } else {
                $maison->setImg2(null);
            }

            $manager = $managerRegistry->getManager();
            $manager->persist($maison);
            $manager->flush();

            $this->addFlash('success', 'La maison a bien été ajoutée');
            // creation du message il faut choisir ou l'afficher 

            //message succes 
            return $this->redirectToRoute('admin_maison_index'); //balance les images dans la page maison 
        }

        return $this->render('admin/maisonForm.html.twig', [
            'maisonForm' => $form->createView()
        ]); // je génére la vue ici 
    }

    #[Route('/admin/maison/update/{id}', name: 'maison_update')]
    public function update(MaisonRepository $maisonRepository, int $id, Request $request, ManagerRegistry $managerRegistry)
    {
        $maison = $maisonRepository->find($id);
        $form = $this->createForm(MaisonType::class, $maison);
        // récup l'id et la maison
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg1 = $form['img1']->getData();
            $nomOldImg1 = $maison->getImg1();
            if ($infoImg1 !== null) {
                $cheminOldImg1 = $this->getParameter('dossier_photos_maisons') . '/' . $nomOldImg1;
                if (file_exists($cheminOldImg1)) {
                    unlink($cheminOldImg1);
                }
                $extensionImg1 = $infoImg1->guessExtension();
                $nomImg1 = time() . '-1' . $extensionImg1;
                $infoImg1->move($this->getParameter('dossier_photos_maisons'), $nomImg1);
                $maison->setImg1($nomImg1);
            } else {
                $maison->setImg1($nomOldImg1);
            }
            $infoImg2 = $form['img2']->getData();
            $nomOldImg2 = $maison->getImg2();
            if ($infoImg2 !== null) {
                if ($nomOldImg2 !== null) {
                    $cheminOldImg2 = $this->getParameter('dossier_photos_maisons') . '/' . $nomOldImg2;
                    if (file_exists($cheminOldImg2)) {
                        unlink($cheminOldImg2);
                    }
                }
                $extensionImg2 = $infoImg2->guessExtension();
                $nomImg2 = time() . '-2.' . $extensionImg2;
                $infoImg2->move($this->getParameter('dossier_photos_maisons'), $nomImg2);
                $maison->setImg2($nomImg2);
            } else {
                $maison->setImg2($nomOldImg2);
            }
            $manager = $managerRegistry->getManager();
            $manager->persist($maison);
            $manager->flush();
            $this->addFlash('success', 'La maison a bien été modifiée');
            return $this->redirectToRoute('admin_maison_index');
        }
        // génération du form

        // traitement si le form est envoyé

        // gestion des images 
        // si img1 dans form => supprime l'ancienne img1 =>  génère le nom de l'img1 => upload de la nouvelle => setImg1
        // si img2 dans form => supprime l'ancienne img2 (si elle existe) => génère le nom de l'img2 => upload de la nouvelle => setImg2
        // envoi en bdd de la maison modifier

        return $this->render('admin/maisonForm.html.twig', [
            'maisonForm' => $form->createView(),
            'maison' => $maison
        ]);
    }

    #[Route('/admin/maison/delete/{id}', name: 'maison_delete')]
    public function delete(MaisonRepository $maisonRepository, int $id, ManagerRegistry $managerRegistry)
    {
        //récup la maison à supprimer (en bdd)
        //supprimer les images
        //supprimer la maison en question
        $maison = $maisonRepository->find($id); // récup la maison grace a son id
        $nomImg1 = $maison->getImg1(); // récup le nom de l'image1
        if ($nomImg1 !== null) { // vérifie qu'il y'a bien un nom d'image (et donc une à supprimer)
            $cheminImg1 = $this->getParameter('dossier_photos_maisons') . '/' . $nomImg1;
            if (file_exists($cheminImg1)) {
                unlink($cheminImg1);
            }
        }
        $nomImg2 = $maison->getImg2();
        if ($nomImg2 !== null) {
            $cheminImg2 = $this->getParameter('dossier_photos_maisons') . '/' . $nomImg2;
            if (file_exists($cheminImg2)) {
                unlink($cheminImg2);
            }
        }
        $manager = $managerRegistry->getManager();
        $manager->remove($maison);
        $manager->flush();
        $this->addFlash('success', 'La maison a bien été supprimé');
        return $this->redirectToRoute('admin_maison_index');
    }
}
