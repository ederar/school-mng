<?php

namespace App\Form;

use App\Entity\Mark;
use App\Entity\Matiere;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('examOne', TextType::class, [
                'required' => false ,
                'attr' => [
                    'placeholder' => 'Exam One Mark !'
                ]
            ])
            ->add('examTwo', TextType::class, [
                'required' => false ,
                'attr' => [
                    'placeholder' => 'Exam Two Mark !'
                ]
            ])
            ->add('matiere', EntityType::class,[
                'class' => Matiere::class,
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
