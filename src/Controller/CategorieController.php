<?php

namespace App\Controller;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CategorieController extends AbstractController
{
   /**
    * @Route("/categorie/add", name="categorie_add" )
    */
    public function addCategorie(Request $request,EntityManagerInterface $em){
       // $categorie = new Categorie();
       // $categorie->setNom("Bijoux");
       // $em->persist($categorie);
       // $em->flush();

        return $this->render("categorie/index.html.twig",[
            'controller_name' => 'CategorieController',
        ]);

    }

}
