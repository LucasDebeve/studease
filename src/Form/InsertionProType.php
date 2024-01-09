<?php

namespace App\Form;

use App\Entity\InsertionProfessionnelle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InsertionProType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDeb', DateType::class, [
                'required' => false,
            ])
            ->add('dateFin', DateType::class, [
                'required' => false,
            ])
            ->add('descInsPro', TextareaType::class, [
                'required' => false,
                'empty_data' => ' ',
            ])
            ->add('teletravail', CheckboxType::class, [
                'required' => false,
            ])
            ->add('titre', TextType::class, [
                'required' => false,
                'empty_data' => ' ',
            ])
            ->add('revenus', MoneyType::class, [
                'required' => false,
                'currency' => '€/jour ouvrés',
            ])
            ->add('typePro', ChoiceType::class, [
                'choices' => [
                    'Stage' => 1,
                    'Alternance' => 2,
                ],
            ])
            ->add('duree', IntegerType::class, [
                'required' => false,
            ])
            ->add('company', EntityType::class, [
                'class' => 'App\Entity\User',
                'choice_label' => 'name',
                'disabled' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InsertionProfessionnelle::class,
        ]);
    }
}
