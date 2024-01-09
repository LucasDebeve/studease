<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Informations personnelles'),
            IdField::new('id')->hideOnForm(),
            BooleanField::new('isVerified', 'Vérifié ?')
                ->setColumns(12),
            TextField::new('name', 'Nom')
                ->setColumns(6),
            TextField::new('firstname', 'Prénom')
                ->setColumns(6),
            EmailField::new('email', 'Email')
                ->setColumns(12),
            TelephoneField::new('telephone', 'Téléphone')->hideOnIndex()
                ->setColumns(6),
            TextField::new('password', 'Mot de passe')->onlyOnForms()
                ->setFormType(PasswordType::class)
                ->setFormTypeOptions([
                    'required' => false,
                    'empty_data' => '',
                    'attr' => ['autocomplete' => 'new-password'],
                ])
                ->setColumns(6),
            ArrayField::new('roles')
                ->formatValue(
                    function ($value) {
                        $res = '';
                        if (in_array('ROLE_ADMIN', $value)) {
                            $res .= '<span class="material-symbols-outlined">shield_person</span>';
                        }
                        if (in_array('ROLE_STUDENT', $value)) {
                            $res .= '<span class="material-symbols-outlined">school</span>';
                        }
                        if (in_array('ROLE_COMPANY', $value)) {
                            $res .= '<span class="material-symbols-outlined">work</span>';
                        }

                        return $res;
                    }
                )
                ->setColumns(12),
            ChoiceField::new('tpUser', 'Type d\'utilisateur')
                ->setChoices([
                    'Administrateur' => 0,
                    'Etudiant' => 1,
                    'Entreprise' => 2,
                ])
                ->hideOnIndex()
                ->setColumns(6),

            FormField::addTab('Pour les étudiants'),
            IntegerField::new('numEtud', 'Numéro étudiant')
                ->hideOnIndex()
                ->setColumns(12),
            AssociationField::new('formation', 'Formation')
                ->setFormTypeOptions(['choice_label' => 'nom'])
                ->hideOnIndex()
                ->setColumns(6),
            AssociationField::new('ecole', 'Ecole')
                ->setFormTypeOptions(['choice_label' => 'nom'])
                ->hideOnIndex()
                ->setColumns(6),

            FormField::addTab('Pour les entreprises'),
            TextareaField::new('descriptionEntreprise', 'Description de l\'entreprise')
                ->hideOnIndex()
                ->setColumns(12),
            IntegerField::new('numSiret', 'Numéro SIRET')
                ->hideOnIndex()
                ->setColumns(6),
            AssociationField::new('localisations', 'Localisations')
                ->setFormTypeOptions(['choice_label' => function ($localisation) {
                    return $localisation->getAdresse().' - '.$localisation->getVille();
                },
                ])
                ->hideOnIndex()
                ->setColumns(6),
        ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setUserPassword($entityInstance);
        parent::updateEntity($entityManager, $entityInstance);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setUserPassword($entityInstance);
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function setUserPassword(User $user): void
    {
        $userRequest = $this->getContext()->getRequest()->get('User');
        if (!empty($userRequest['password'])) {
            $password = $userRequest['password'];
            $user->setPassword($this->hasher->hashPassword($user, $password));
        }
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('email')
            ->add(
                ChoiceFilter::new('tpUser', 'Type d\'utilisateur')
                ->setChoices([
                    'Administrateur' => 0,
                    'Etudiant' => 1,
                    'Entreprise' => 2,
                ])
            )
            ->add('name')
            ->add('firstname')
            ->add('isVerified')
        ;
    }
}
