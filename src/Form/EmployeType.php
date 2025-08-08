<?php
namespace App\Form;

use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, ['label' => 'Prénom'])
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('level_access', ChoiceType::class, [
                'label' => 'Niveau d’accès',
                'choices' => [
                    'Admin' => 'Admin',
                    'User'  => 'User',
                ],
                'placeholder' => 'Choisir…',
            ])
            ->add('contract_type', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'Freelance' => 'Freelance',
                ],
                'placeholder' => 'Choisir…',
            ])
            ->add('arrived_date', DateType::class, [
                'label' => 'Date d’arrivée',
                'widget' => 'single_text',   // input type="date"
                'required' => false,
            ])
            ->add('email', EmailType::class, ['label' => 'Email'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Employe::class]);
    }
}
