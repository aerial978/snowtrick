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
                'placeholder' => 'https://www.youtube.com/watch?v=_hxLS2ErMiY&t=4s',
            ],
            'label' => 'YouTube video link',
            'label_attr' => [
                'class' => 'mt-4 mb-2',
            ],
        /*    'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Please upload a file !',
                ]),
                new Assert\Regex([
                    'pattern' => '/^htpps?:\/\/(?:www\.)?youtube\.com\/watch\?v=[\w\-]+(?:&t=\d+s?)?$/',
                    'message' => 'Invalid YouTube video URL format !',
                    ]),
            ],*/
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
