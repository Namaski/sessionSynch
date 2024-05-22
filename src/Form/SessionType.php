<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Student;
use App\Entity\Formation;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sessionName', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('startDate', null, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ]
            ], DateTimeType::class, ['date_widget' => 'single_text'])
            ->add('endDate', null, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ]
            ], DateTimeType::class, ['date_widget' => 'single_text'])
            ->add('maxStudent', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('formation', EntityType::class, [
                'class' => Formation::class,
                'choice_label' => 'nameFormation',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('programs', CollectionType::class, [
                'entry_type' => ProgramType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'attr' => [
                    'class' => 'uk-input'
                ]
            ])
            ->add('students', EntityType::class, [
                'class' => Student::class,
                'choice_label' => function ($student) {
                    return $student->getName() . ' ' . $student->getFirstName();
                
                },
                'attr' => [
                    'class' => 'form-control'
                ],
                'multiple' => true,
            ])
            ->add('Valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
