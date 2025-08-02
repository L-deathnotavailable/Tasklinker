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
                'choice_label' => 'name',
                'multiple' => true,
                'label' => 'Inviter des membres',
                'required' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Continuer',
                'attr' => ['class' => 'button button-submit'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
