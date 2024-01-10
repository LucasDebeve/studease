<?php

namespace App\Form;

use App\Entity\InsertionProfessionnelle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InsertionProType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDeb', DateType::class, [
                'empty_data' => ' ',
            ])
            ->add('dateFin', DateType::class, [
                'empty_data' => ' ',
                'required' => false,
            ])
            ->add('descInsPro', TextareaType::class, [
                'empty_data' => ' ',
            ])
            ->add('teletravail', CheckboxType::class, [
                'required' => false,
            ])
            ->add('titre', TextType::class, [
                'empty_data' => ' ',
            ])
            ->add('revenus', MoneyType::class, [
                'empty_data' => ' ',
                'currency' => 'EUR',
            ])
            ->add('typePro', IntegerType::class, [
                'empty_data' => ' ',
            ])
            ->add('duree', IntegerType::class, [
                'empty_data' => ' ',
            ])
            ->add('localisation', EntityType::class, [
                'class' => 'App\Entity\Localisation',
                'choice_label' => 'entreprise',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InsertionProfessionnelle::class,
        ]);
    }
}
