<?php

namespace App\Form;

use App\Entity\Mark;
use App\Entity\Matiere;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Mark1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('examOne')
            ->add('examTwo')
            ->add('student', EntityType::class,[
                'class' => Student::class,
                'choice_label' => 'lastName'
            ])
            ->add('matiere', EntityType::class, [
                'class' => Matiere::class ,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mark::class,
        ]);
    }
}
