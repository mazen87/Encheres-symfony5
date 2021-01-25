<?php

namespace App\Form;

use App\Entity\Annonce;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,[
                'label'=> false,
                'attr' =>[
                    'placeholder'=>'Titre'
                ]
            ])
            ->add('description',TextareaType::class,[
                'label'=> false,
                'attr' =>[
                    'placeholder'=>'Deescription'
                ]
            ])
            
            ->add('prixDepart',NumberType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Prix de Départ'
                ]
            ])
            ->add('prixImmediat',NumberType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Prix immédiat'
                ]
            ])
            ->add('prixPropose',NumberType::class,[
                'label'=>false,
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'Prix proposé'
                   
                ]
            ])
            ->add('dateFin',DateType::class,[
                'attr'=>[
                    'class'=>'formLabel'
                ]
            ])
            ->add('imageFile',VichImageType::class,[
                'required'=>false,
                'attr'=>[
                    'class'=>'formLabel'
                ]
            ])
            ->add('categorie',EntityType::class,[
                'class'=>Categorie::class,
                'choice_label'=>'nom',
                'label'=>false
            ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
