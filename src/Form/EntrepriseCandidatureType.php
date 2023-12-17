<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class EntrepriseCandidatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'En attente' => 'en_attente',
                    'Accepté' => 'accepte',
                    'Refusé' => 'refuse',
                ],
                'label' => 'Statut de la candidature',
            ]);
    }
}
