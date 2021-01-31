<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserInscriptionType;
use App\Form\UserModificationType;
use App\Repository\AnnonceRepository;
use App\Repository\EnchereRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{


    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/inscription", name="user_inscription")
     */
    public function inscription(Request $request , EntityManagerInterface $em,UserPasswordEncoderInterface $encoder){
        $user = new User();
        $user->setRoles('ROLE_USER');
        $user->setActive(true);
        $inscriptionForm = $this->createForm(UserInscriptionType::class,$user);
        $inscriptionForm->handleRequest($request);
        if($inscriptionForm->isSubmitted() && $inscriptionForm->isValid()){
            $motDePasseHache = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($motDePasseHache);

            $em->persist($user);
            $em->flush();
            $this->addFlash('succes','vous vous avez bien inscrit');
            return $this->redirectToRoute('login');
        }

        return $this->render("user/inscription.html.twig",[
            'inscriptionForm'=>$inscriptionForm->createView()
        ]);
    }

    /**
     * @Route("/monProfil/{id}", name="mon_profil")
     */
    public function modifierMonProfil(Request $request , EntityManagerInterface $em,$id,UserRepository $userRepo){
            $user = $userRepo->find($id);
            //dump($user);
            //$motdePasse = $user->getPassword();
            //dump($motdePasse);
            $modificationForm = $this->createForm(UserModificationType::class,$user);
            $modificationForm->handleRequest($request);
            //dump($modificationForm);
            if($modificationForm->isSubmitted() &&  $modificationForm->isValid()){
            
                    $em->persist($user);
                    $em->flush();
                    $this->addFlash('succes','votre profil a été modifié avec succes !');
            }

            return $this->render("user/monProfil.html.twig",[
                'modificationForm' => $modificationForm->createView()
            ]);
    }  

     /**
     * @Route("/monProfilMdP/{id}", name="mon_profil_mdp")
     */
    public function modifierMonProfilMdP(Request $request , EntityManagerInterface $em,UserPasswordEncoderInterface $encoder,$id,UserRepository $userRepo){
        $user = $userRepo->find($id);
        //dump($user);
        //$motdePasse = $user->getPassword();
        //dump($motdePasse);
        $modificationForm = $this->createForm(UserInscriptionType::class,$user);
        $modificationForm->handleRequest($request);
        //dump($modificationForm);
        if($modificationForm->isSubmitted() &&  $modificationForm->isValid()){
            $motDePasseHache = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($motDePasseHache);
                $em->persist($user);
                $em->flush();
                $this->addFlash('succes','votre profil a été modifié avec succes !');
        }

        return $this->render("user/mdpMonProfil.html.twig",[
            'modificationForm' => $modificationForm->createView()
        ]);
}  


    /**
     * @Route("/login", name="login")
     */
    public function connexion(){


        return $this->render("user/login.html.twig");
    }

    /**
     * @Route("/", name="accueil")
     */
    public function accueil(AnnonceRepository $annonceRepo,EntityManagerInterface $em,Request $request ){
        $annonces = $annonceRepo->selectToutesAnnonces();
        //$annonces = $annonceRepo->findAll();
        dump($annonces);
          
        return $this->render("user/accueil.html.twig",[
            'annonces'=>$annonces
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function deconnexion (){

    }
}
