<?php

namespace App\Form;

use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleEn', TextType::class, array('attr' => array( 'class' => 'form-control')))
            ->add('titleFr', TextType::class, array('attr' => array( 'class' => 'form-control')))
            ->add('descriptionEn', TextareaType::class, array('attr' => array( 'class' => 'editor form-control')))
            ->add('descriptionFr', TextareaType::class, array('attr' => array( 'class' => 'editor form-control')))
            ->add('skilltype', ChoiceType::class, array(
                'choices' => array(
                    'Technical' => 'T', 'Functional' => 'F', 'Core' => 'C'),
                'multiple' => false,
                'expanded' => true,
            ))
            ->add('levels', CollectionType::class, array(
                'entry_type' => LevelType::class,
                'allow_add' => true,
                'prototype' => true,
                'by_reference' => false,

            ))


            // ->add('status')
            // ->add('dateCreated')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
