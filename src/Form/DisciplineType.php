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
            ->add('titleEn', TextType::class, array(
                'label' => 'form.discipline.titleEn',
                'attr' => array( 'class' => 'form-control')))
            ->add('titleFr', TextType::class, array(
                'label' => 'form.discipline.titleFr',
                'attr' => array( 'class' => 'form-control')))
            ->add('descriptionEn', TextareaType::class, array(
                'label' => 'form.discipline.descriptionEn',
                'attr' => array( 'class' => 'editor form-control')))
            ->add('descriptionFr', TextareaType::class, array(
                'label' => 'form.discipline.descriptionFr',
                'attr' => array( 'class' => 'editor form-control')))
            ->add('grade', ChoiceType::class, array(
                    'label' => 'form.discipline.level',
                    'choices' => array(
                        '0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7', 7, '8' => 8),

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
                'label' => 'form.discipline.skills',
                'allow_add' => true,
                'prototype' => true,
                'by_reference' => false,

            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Discipline::class,
        ]);
    }
}
