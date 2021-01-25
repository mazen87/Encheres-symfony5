<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserModificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,  
            ['label'=>false,
            'attr' => [
            'placeholder' => 'Pseudo'
        ]
        ] )
            ->add('nom',TextType::class,
            ['label'=>false,
            'attr' => [
            'placeholder' => 'Nom'
        ]
        ] )
            ->add('prenom',TextType::class,
            ['label'=>false,
            'attr' => [
            'placeholder' => 'Prénom'
        ]
        ] )
            ->add('adresse',TextType::class,
            ['label'=>false,
            'attr' => [
            'placeholder' => 'Addresse'
        ]
        ] )
            //->add('password',PasswordType::class)
            /*
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'le mot de passe doit être confirmé',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => false,
                'first_options'  => ['label' => false,'attr'=>['placeholder'=>'Mot de passe']],
                'second_options' => ['label' => false,'attr'=>['placeholder'=>'répétez votre Mot de passe']],
            ])
            */
            ->add('telephone', TelType::class,
            ['label'=>false,
            'attr' => [
            'placeholder' => 'Téléphone'
        ]
        ] )
            ->add('email',EmailType::class,
            ['label'=>false,
            'attr' => [
            'placeholder' => 'Email'
        ]
        ] )
           // ->add('roles')
           // ->add('active')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
