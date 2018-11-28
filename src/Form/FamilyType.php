<?php

namespace App\Form;

use App\Entity\Family;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FamilyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleEn')
            ->add('titleFr')
            ->add('descriptionEn')
            ->add('descriptionFr')
            ->add('disciplines', CollectionType::class, array(
                'entry_type' => DisciplineType::class,
                'allow_add' => true,
                'prototype' => true,
                'by_reference' => false,

            ))
            // ->add('status')
            //->add('dateCreated')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Family::class,
        ]);
    }
}
