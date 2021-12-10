<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => "Prénom",
                'constraints' => new Length(0,2,30),
                'attr' => [
                    'placeholder' => "Votre prénom"
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => "Nom",
                'constraints' => new Length(0,2,30),
                'attr' => [
                    'placeholder' => "Votre nom"
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => "Identifiant/E-mail",
                'constraints' => new Length(0,5,50),
                'attr' => [
                    'placeholder' => "Votre e-mail"
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => "Le mot de passe et la confirmation doivent être identiques.",
                'label' => "Mot de passe",
                'constraints' => new Length(0,8,50),
                'required' => true,
                'first_options' => [
                    'label' => "Mot de passe",
                'attr' => [
                    'placeholder' => "Saisissez votre mot de passe ici"
                ]],
                'second_options' => [
                    'label' => "Confirmation de votre mot de passe",
                'attr' => [
                    'placeholder' => "Merci de répéter votre mot de passe"                ]]
                ],
            )
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
