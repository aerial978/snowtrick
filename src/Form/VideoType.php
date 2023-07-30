<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('newVideoLink', TextType::class, [
            'mapped' => false,
            'required' => false,
            'attr' => [
                'class' => 'form-control',
            ],
            'label' => 'New video',
            'label_attr' => [
                'class' => 'mt-4 mb-2',
            ],
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Please upload a file !',
                ]),
            ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
