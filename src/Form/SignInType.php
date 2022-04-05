<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'required'=>true
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
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
            ->add(
                $builder->create('adress', FormType::class, ['by_reference'=> true])
                ->add('ville', TextType::class ,[
                    'label' => 'Ville',
                ])
                ->add('cp', IntegerType::class,[
                    'label' => 'Code Postal',
                ])
                ->add('rue', TextType::class,[
                    'label' => 'Adresse',
                ])
                ->add('complement', TextareaType::class,[
                    'label' => 'Complément d\'adresse',
                ])
            )

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
