<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ResetPasswordRequestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'autocomplete' => 'email',
                    'class' => 'form-control mt-3',
                ],
                'required' => false,
                'label' => 'Email',
                'label_attr' => [
                'class' => 'mt-3 text-info fs-5 fw-bold',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Please enter your email !',
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^\S+@\S+\.\S+$/',
                        'message' => 'Invalid email address format !',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
