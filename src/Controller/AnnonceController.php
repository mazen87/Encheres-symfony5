<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Enchere;
use App\Entity\User;
use App\Form\AnnonceType;
use App\Form\EnchereType;
use App\Repository\AnnonceRepository;
use App\Repository\EnchereRepository;
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

    /**
     * @Route("annonce/encherir/{id}", name="annonce_encherir")
     */
    public function encherir(Request $request, EntityManagerInterface $em,AnnonceRepository $annonceRepo,EnchereRepository $enchereRepo, $id){
        $user = $this->getUser();
        $annonce = $annonceRepo->find($id);
        $enchere = new Enchere();
        $enchere->setEncherisseur($user);
        $enchere->setAnnonce($annonce);
        $enchere->setDateEnchere(new \DateTime());
        $enchereForm = $this->createForm(EnchereType::class, $enchere);
        $enchereForm->handleRequest($request);
        if($enchereForm->isSubmitted() && $enchereForm->isValid()){
            if($annonce->getPrixPropose()!==null){
                if($enchere->getPrix()<= $annonce->getPrixPropose()){
                    $this->addFlash('error','le montant de votre enchère doit être supérieure du meuilleur enchère précédente !');
                    return $this->redirectToRoute("annonce_encherir",['id'=>$id]);
                }

            }else{
                if($enchere->getPrix() <= $annonce->getPrixDepart()){
                    $this->addFlash('error','le montant de votre enchère doit être supérieure du prix de départ !');
                    return $this->redirectToRoute("annonce_encherir",['id'=>$id]);
                }
            }

            
            $annonce->setPrixPropose($enchere->getPrix());
            $em->persist($enchere);
            $em->persist($annonce);
            $em->flush();

            $this->addFlash('succes','votre enchère a bien été enregistrée !');
            return $this->redirectToRoute("accueil");
        }

        return $this->render("annonce/ajouterEnchere.html.twig",[
            'annonce'=> $annonce,
            'enchereForm'=> $enchereForm->createView()
        ]);

    }

    /**
     * @Route("annonce/achatImmediat" , name="achat_immediat")
     */
    public function achatImmediat(){
        return $this->render("annonce/achatImmediat.html.twig");
    }
}
