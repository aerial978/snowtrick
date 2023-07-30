<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Add message',
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Please write your message !',
                    ]),
                ],
            ])

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-info btn-lg mx-3 p-3',
                ],
                'label' => 'Send',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
