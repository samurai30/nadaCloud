<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class)
            ->add('plainPassword',RepeatedType::class,[
                'type' => PasswordType::class,
                'first_options' => ['attr' =>  ['placeholder' => 'password'],
                    'label' => false],
                'second_options' => ['attr' => ['placeholder' => 'confirm password']
                    , 'label' => false],
                'label' => 'Password'
            ])
            ->add('email', EmailType::class)
            ->add('firstName',TextType::class)
            ->add('lastName',TextType::class)
            ->add('profilePicPath', FileType::class,[
                'mapped' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
