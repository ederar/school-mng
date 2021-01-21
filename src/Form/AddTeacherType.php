<?php

namespace App\Form;

use App\Entity\ClassRoom;
use App\Entity\Matiere;
use App\Entity\Role;
use App\Entity\Teacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddTeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('password', PasswordType::class)
            ->add('matiere', EntityType::class,[
                'class' => Matiere::class,
                'choice_label' => 'name'
            ])
            ->add('classRoom', EntityType::class,[
                'class' => ClassRoom::class,
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('role', EntityType::class,[
                'class' => Role::class,
                'choice_label' => 'title',
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
        ]);
    }
}

