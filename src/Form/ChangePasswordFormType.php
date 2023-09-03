<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
                new Assert\NotBlank([
                    'message' => 'Please enter a password !',
                ]),
                /*new Assert\Length([
                    'min' => 8,
                    'max' => 255,
                    'minMessage' => 'Your password should be at least {{ limit }} characters !',
                ]),*/
                new Assert\Regex([
                    'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                    'message' => 'Your password must contain at least 8 characters, one lowercase letter, one uppercase letter, one number and one special character !',
                ]),
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
