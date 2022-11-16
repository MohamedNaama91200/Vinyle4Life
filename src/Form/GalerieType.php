<?php

namespace App\Form;

use App\Entity\Galerie;
use App\Repository\GalerieRepository;
use App\Repository\ObjetRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //dump($options);
        $galerie = $options['data'] ?? null;
        $membre = $galerie->getCreateur();

        $builder
            ->add('description')
            ->add('publiee')
            ->add('createur', null, [
                'disabled'   => true,
            ])
            ->add('objet', null, [
                'query_builder' => function (ObjetRepository $er) use ($membre) {
                        return $er->createQueryBuilder('g')
                        ->leftJoin('g.inventaire', 'i')
                        ->andWhere('i.membre = :membre')
                        ->setParameter('membre', $membre)
                        ;
                    }
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Galerie::class,
        ]);
    }
}
