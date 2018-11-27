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

class DisciplineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleEn')
            ->add('titleFr')
            ->add('descriptionEn')
            ->add('descriptionFr')

            ->add('grade', ChoiceType::class, array(
                'label'=>'Level',
                'choices' => array(
                '0'=>0,'1'=>1, '2'=>2, '3'=>3, '4'=>4, '5'=>5, '6'=>6, '7',7, '8'=>8),
                 'multiple'=>true,
                    'expanded'=>true,
            )
            )
            ->add('family',EntityType::class,array(
              'class'=>Family::class,
              'choice_label'=>'titleEn',
            ))
            ->add('disciplinesd', CollectionType::class, array(
                'entry_type' => DisciplineSkillLevelType::class,
                'label'=>'Skills',
                'allow_add' => true,
                'prototype' => true,
                'by_reference'=>false,

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
