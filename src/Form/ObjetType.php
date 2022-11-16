<?php

namespace App\Form;

use App\Entity\Objet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('Titre')
            ->add('Nb_de_tours')
            ->add('Neuf')
            ->add('Annee')
            ->add('Album')
            ->add('Duree')
            ->add('inventaire')
            ->add('Vinyle')
            ->add('format')
            ->add('style')
            ->add('galeries')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Objet::class,
        ]);
    }
}
