<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignInType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required'=>true
            ])
            
            ->add('password', RepeatedType::class, [
                'type'=> PasswordType::class,
                'required'=>true,
                'first_options' => [
                    'label' => 'Votre mot de passe', 
                ],
                'second_options' => [
                    'label'=> 'Répétez votre mdp :',
                ]
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Téléphone'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
