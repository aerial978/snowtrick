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
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => false,
                'label_attr' => [
                    'class' => 'form-label mt-3 text-info fs-5 fw-bold',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a name !',
                    ]),
                ],
            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'minlength' => '2',
                    'maxlength' => '180',
                    'class' => 'form-control',
                ],
                'required' => false,
                'label_attr' => [
                    'class' => 'form-label mt-3 text-info fs-5 fw-bold',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a email !',
                    ]),
                ],
            ])

            ->add('profilePicture', FileType::class, [
                'mapped' => false,
                'multiple' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Profile picture (optional)',
                'label_attr' => [
                    'class' => 'mt-2 mb-2 text-info fs-5 fw-bold',
                ],
                /*'constraints' => [
                    new NotBlank([
                        'message' => 'Please upload one file !',
                    ]),
                ]*/
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'passwords do not match !',
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'text-danger',
                ],
                'required' => false,
                'first_options' => [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label' => 'Password',
                    'label_attr' => [
                        'class' => 'form-label mt-3 text-info fs-5 fw-bold',
                    ],
                ],
                'second_options' => [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label' => 'Password Confirmation',
                    'label_attr' => [
                        'class' => 'form-label mt-3 text-info fs-5 fw-bold',
                    ],
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password !',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Your password should be at least {{ limit }} characters !',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
            ])
            /* ->add('picture') */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
