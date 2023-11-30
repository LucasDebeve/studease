<?php

namespace App\Form;

use App\Entity\Ecole;
use App\Entity\Formation;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Get the user
        $user = $options['data'];
        $builder
            ->add('email', EmailType::class, [
                'empty_data' => '',
                'attr' => ['class' => 'form-control w-100'],
            ])
            ->add('password', PasswordType::class, [
                'empty_data' => '',
                'attr' => ['autocomplete' => 'new-password', 'class' => 'form-control w-100'],
                'required' => false,
                'mapped' => false,
            ])
            ->add('telephone', TelType::class, [
                'empty_data' => '',
                'attr' => ['class' => 'form-control w-100'],
            ])
            ->add('avatar', FileType::class, [
                'label' => 'Avatar',
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'form-control w-100'],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['image/png', 'image/jpeg', 'image/jpg'],
                        'mimeTypesMessage' => 'Veuillez transmettre un fichier image valide',
                    ]),
                ],
            ])
            ->add('name', TextType::class, [
                'empty_data' => '',
                'attr' => ['class' => 'form-control w-100'],
            ])
        ;
        // Verify if the user is a student or a company
        if (1 === $user->getTpUser()) {
            $builder
                ->add('formation', EntityType::class, [
                    'class' => Formation::class,
                    'choice_label' => 'nom',
                    'query_builder' => function ($entityRepository) {
                        // Get all formation which is related to the user ecole
                        return $entityRepository->createQueryBuilder('f')
                            ->orderBy('f.nom', 'ASC');
                    },
                    'required' => false,
                    'attr' => ['class' => 'form-control w-100'],
                ])
                ->add('ecole', EntityType::class, [
                    'class' => Ecole::class,
                    'choice_label' => 'nom',
                    'query_builder' => function ($entityRepository) {
                        return $entityRepository->createQueryBuilder('e')
                            ->orderBy('e.nom', 'ASC');
                    },
                    'required' => false,
                    'attr' => ['class' => 'form-control w-100'],
                ],
                )
                ->add('firstname', TextType::class, [
                    'empty_data' => '',
                    'attr' => ['class' => 'form-control w-100'],
                ])
                ->add('numEtud', TextType::class, [
                    'empty_data' => '',
                    'attr' => ['class' => 'form-control w-100'],
                ])
            ;
        } elseif (2 === $user->getTpUser()) {
            $builder
                ->add('descriptionEntreprise', TextareaType::class, [
                    'empty_data' => '',
                    'attr' => ['class' => 'form-control w-100', 'style' => 'resize: none; height: 5rem;'],
                ])
                ->add('numSiret', TextType::class, [
                    'empty_data' => '',
                    'attr' => ['class' => 'form-control w-100'],
                ])
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
