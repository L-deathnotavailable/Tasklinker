<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Titre du projet',
                'required' => true,
            ])
            ->add('employes', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => fn (Employe $e) => sprintf('%s %s', $e->getFirstname(), $e->getName()),
                'multiple' => true,
                'autocomplete' => true,
                'label' => 'Inviter des membres',
                'required' => false,
                'attr' => [
                    'class' => 'select2-multiple',
                    'data-placeholder' => 'Sélectionnez des membres'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
