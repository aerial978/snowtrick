<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('newPictureLink', FileType::class, [
            'mapped' => false,
            'multiple' => true,
            'required' => false,
            'attr' => [
                'class' => 'form-control',
            ],
            'label' => 'Picture(s)',
            'label_attr' => [
                'class' => 'mt-2 mb-2 fw-bold'
            ],
              'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Please upload at least one file !',
                ]),
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
