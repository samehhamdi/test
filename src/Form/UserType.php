<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Role;
use App\Form\RoleType;
use App\Repository\UserRepository;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('roles', EntityType::class, array(
                'class' => Role::class,
                'required'   => false,
                'empty_data' => NULL,
                'choice_label' => 'name',
                'multiple'=>true,
                'expanded'=>true,
                'attr' => array('class' => 'form-control')
            ))
            ->add('email', ChoiceType::class, array(
                'choices' => UserRepository::getADUsersByUsername('j'),
                'placeholder' => '',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
