<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\User;
use App\Form\AnnonceType;
use App\Repository\AnnonceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    /**
     * @Route("annonce/add", name="annonce_add")
     */
    public function addAnnonce (EntityManagerInterface $em, Request $request,AnnonceRepository $annonceRepo){
        $annonce = new Annonce();
        $annonce->setDateCreation(new \DateTime());
        $annonce->setDisponible(true);
        $user=new User();
        $user = $this->getUser();
        $annonce->setCreateur($user);
        $formAddAnnonce = $this->createForm(AnnonceType::class,$annonce);
        $formAddAnnonce->handleRequest($request);
        if($formAddAnnonce->isSubmitted() && $formAddAnnonce->isValid()){
            $em->persist($annonce);
            $em->flush();

            $this->addFlash('succes','votre annonce a été ajouté avec succes');
            return $this->redirectToRoute('accueil');
        }
        return $this->render("annonce/addAnnonce.html.twig",[
            'formAddAnnonce' => $formAddAnnonce->createView()
        ]);

    }

        /**
     * @Route("annonce/modifier/{id}", name="annonce_modifier")
     */
    public function modifierAnnonce (EntityManagerInterface $em, Request $request,AnnonceRepository $annonceRepo,$id){
        $annonce = new Annonce();
        $annonce= $annonceRepo->find($id);
        //$annonce->setDateCreation(new \DateTime());
        //$annonce->setDisponible(true);
        //$user=new User();
        //$user = $this->getUser();
        //$annonce->setCreateur($user);
        $formModifierAnnonce = $this->createForm(AnnonceType::class,$annonce);
        $formModifierAnnonce->handleRequest($request);
        if($formModifierAnnonce->isSubmitted() && $formModifierAnnonce->isValid()){
            dump($annonce);
            $em->persist($annonce);
            $em->flush();

            $this->addFlash('succes','votre annonce a été modifié avec succes');
            return $this->redirectToRoute('accueil');
        }
        return $this->render("annonce/modifierAnnonce.html.twig",[
            'formModifierAnnonce' => $formModifierAnnonce->createView()
        ]);

    }
}
