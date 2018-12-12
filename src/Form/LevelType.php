<?php

namespace App\Form;

use App\Entity\Level;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class LevelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleEn',TextType::class, array(
                'label' => 'form.level.titleEn',
                'attr' => array( 'class' => 'form-control')))
            ->add('titleFr',TextType::class, array(
                'label' => 'form.level.titleFr',
                'attr' => array( 'class' => 'form-control')))
            ->add('descriptionEn',TextType::class, array(
                'label' => 'form.level.descriptionEn',
                'attr' => array( 'class' => 'form-control')))
            ->add('descriptionFr',TextType::class, array(
                'label' => 'form.level.descriptionFr',
                'attr' => array( 'class' => 'form-control')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Level::class,
        ]);
    }
}
