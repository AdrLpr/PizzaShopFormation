<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
