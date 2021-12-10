<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => "Mon adresse mail"
            ])
            ->add('lastname', TextType::class, [
                'disabled' => true,
                'label' => "Mon nom"
            ])
            ->add('firstname', TextType::class, [
                'disabled' => true,
                'label' => "Mon prénom"
            ])
            ->add('old_password', PasswordType::class, [
                'label' => "Mon mot de passe actuel",
                'mapped' => false,
                'attr' => [
                    'placeholder' => "Veuillez saisir votre mot de passe actuel"
                ]
            ])
            ->add(
                'new_password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'mapped' => false,
                    'invalid_message' => "Le mot de passe et la confirmation doivent être identiques.",
                    'label' => "Mot de passe",
                    'constraints' => new Length(0, 8, 50),
                    'required' => true,
                    'first_options' => [
                        'label' => "Mon nouveau mot de passe",
                        'attr' => [
                            'placeholder' => "Saisissez votre nouveau mot de passe ici"
                        ]
                    ],
                    'second_options' => [
                        'label' => "Confirmation de mon nouveau mot de passe",
                        'attr' => [
                            'placeholder' => "Merci de répéter votre mot de passe"
                        ]
                    ]
                ],
            )
            ->add('submit', SubmitType::class, [
                'label' => "Mettre à jour"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
