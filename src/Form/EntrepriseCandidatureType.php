<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class EntrepriseCandidatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Statut', ChoiceType::class, [
                'choices' => [
                    'En attente' => 0,
                    'Accepté' => 1,
                    'Refusé' => 2,
                ],
            ]);
    }
}
