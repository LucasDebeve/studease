<?php

namespace App\Form;

use App\Entity\Localisation;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use phpDocumentor\Reflection\PseudoTypes\IntegerRange;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocalisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresse', TextType::class, [
                'empty_data' => '',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('code_postal', TextType::class, [
                'empty_data' => '',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('ville', TextType::class, [
                'empty_data' => '',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('latitude', NumberType::class, [
                'empty_data' => '',
                'scale' => 6,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('longitude', NumberType::class, [
                'empty_data' => '',
                'scale' => 6,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('pays', CountryType::class, [
                'empty_data' => '',
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
            ->add('entreprise', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'attr' => [
                    'class' => 'form-select',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Localisation::class,
        ]);
    }
}
