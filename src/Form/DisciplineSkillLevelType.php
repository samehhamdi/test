<?php

namespace App\Form;

use App\Entity\DisciplineSkillLevel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Discipline;
use App\Entity\Level;
use App\Entity\Skill;

class DisciplineSkillLevelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*  ->add('discipline',EntityType::class,array(
                  'class'=>Discipline::class,
                  'choice_label'=>'titleEn',
              ))*/
            ->add('disciplineLevel', ChoiceType::class, array(
                'choices' => array(
                    '0' => '0', '1' => '1', '2' => '2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8'),
                'multiple' => false,
                'expanded' => false,
            ))
            ->add('skill', EntityType::class, array(
                'class' => Skill::class,
                'choice_label' => 'titleEn',
            ))
            ->add('level', EntityType::class, array(
                'class' => Level::class,
                'choice_label' => 'titleEn',
            ))
            ->add('importance', ChoiceType::class, array(
                'choices' => array(
                    'Key' => 'key', 'Major' => 'major', 'Minor' => 'minor'),
                'multiple' => false,
                'expanded' => true,
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DisciplineSkillLevel::class,
        ]);
    }
}
