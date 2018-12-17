<?php

namespace App\Form;

use App\Entity\Discipline;
use App\Entity\Family;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DisciplineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleEn', TextType::class, array('attr' => array( 'class' => 'form-control')))
            ->add('titleFr', TextType::class, array('attr' => array( 'class' => 'form-control')))
            ->add('descriptionEn', TextareaType::class, array('attr' => array( 'class' => 'editor form-control')))
            ->add('descriptionFr', TextareaType::class, array('attr' => array( 'class' => 'editor form-control')))
            ->add('grade', ChoiceType::class, array(
                    'label' => 'Level',
                    'choices' => array(
                        '0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7', 7, '8' => 8),
                    'multiple' => true,
                    'expanded' => true,
                    'attr' => array('class' => 'checkbox-group horizontal-group')
                )
            )
            ->add('family', EntityType::class, array(
                'class' => Family::class,
                'required'   => false,
                'empty_data' => NULL,
                'placeholder' => 'unassigned',
                'choice_label' => 'titleEn',
                'attr' => array('class' => 'form-control')
            ))
            ->add('disciplinesd', CollectionType::class, array(
                'entry_type' => DisciplineSkillLevelType::class,
                'label' => 'Competencies',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => false,
                'by_reference' => false,

            ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Discipline::class,
        ]);
    }
}
