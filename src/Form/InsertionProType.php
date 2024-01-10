<?php

namespace App\Form;

use App\Entity\InsertionProfessionnelle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InsertionProType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDeb')
            ->add('dateFin')
            ->add('descInsPro')
            ->add('teletravail')
            ->add('titre')
            ->add('revenus')
            ->add('typePro')
            ->add('duree')
            ->add('company')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InsertionProfessionnelle::class,
        ]);
    }
}
