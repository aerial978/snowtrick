<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class EditPictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('editPicture', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Edit picture',
                'label_attr' => [
                    'class' => 'mt-2 mb-2 fw-bold',
                ],
                'constraints' => [
                    new Assert\NotNull([
                        'message' => 'Please upload at least one file !',
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
