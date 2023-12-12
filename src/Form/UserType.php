<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Ville;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('adresse')
            ->add('idVille', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'Nom', // ou tout autre champ à afficher dans le menu déroulant
                'placeholder' => 'Choose a city', // texte optionnel à afficher en haut du menu déroulant
                // ...
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}