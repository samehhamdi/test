<?php

namespace App\Form;

use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('titleEn', TextType::class, array('label' => 'form.skill.titleEn','attr' => array( 'class' => 'form-control')))
            ->add('titleFr', TextType::class, array('label' => 'form.skill.titleFr','attr' => array( 'class' => 'form-control')))
            ->add('descriptionEn', TextareaType::class, array('label' => 'form.skill.descriptionEn','attr' => array( 'class' => 'editor form-control')))
            ->add('descriptionFr', TextareaType::class, array('label' => 'form.skill.descriptionFr','attr' => array( 'class' => 'editor form-control')))
            ->add('skilltype', ChoiceType::class, array(
                'label' => 'form.skill.skilltype',
                'choices' => array(
                    'Technical' => 'T', 'Functional' => 'F', 'Core' => 'C'),
                'choice_label' => function ( $key) {
                    return 'form.skill.'.$key;
                },
                'multiple' => false,
                'expanded' => true,
                'attr' => array('class' => 'checkbox-group horizontal-group group-md')
            ))
            ->add('levels', CollectionType::class, array(
                'label' => 'form.skill.levels',
                'entry_type' => LevelType::class,
                'allow_add' => true,
                'prototype' => false,
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
