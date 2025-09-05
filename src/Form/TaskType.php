<?php
namespace App\Form;
use App\Entity\Task;
use App\Entity\Employe;
use App\Entity\States;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $b, array $opt): void
    {
        $b
            ->add('title', TextType::class, ['label' => 'Titre de la tâche'])
            ->add('description', TextareaType::class, ['label' => 'Description', 'required' => false])
            ->add('deadline', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('state', EntityType::class, [
                'class' => States::class,
                'choice_label' => 'name',
            ])
            ->add('employe', EntityType::class, [
                'class' => Employe::class,
                'label' => 'Membre',
                'required' => false,
                // 'choices' => $opt['project'] ? $opt['project']->getEmployes() : [],
                'choice_label' => fn(Employe $e) => $e->getFirstname().' '.$e->getName(),
                'placeholder' => '',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
            'project' => null,
        ]);
    }
}
