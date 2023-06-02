<?php

namespace App\Form;

use App\Entity\Trick;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
         ->add('name', TextType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'required' => false,
            'label' => 'Nom',
            'label_attr' => [
                'class' => 'form-label mt-2 fw-bold'
            ],
            'constraints' => [
                new Assert\Length([
                    'min' => 2,
                    'minMessage' => 'Must have at least 2 characters !',
                    'max' => 50]),
                new Assert\NotBlank([
                    'message' => 'Please, fill in this field !'
                ]),
            ]
        ])
        
        ->add('description', TextareaType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'required' => false,
            'label' => 'Description',
            'label_attr' => [
                'class' => 'form-label mt-2 fw-bold'
            ],
            'constraints' => [
                new Assert\NotNull([
                    'message' => 'Please, fill in this field !'
                ]),
            ]
        ])

        ->add('category', EntityType::class, [  
            'class' => Category::class,
            'attr' => [
                'class' => 'form-select',
            ],
            'required' => false,
            'label' => 'Category',
            'placeholder' => 'Please choose a category',
            'choice_label' => 'name',
            'query_builder' => function (CategoryRepository $t) {
                return $t->createQueryBuilder('c')
                ->orderBy('c.name', 'ASC');
            },
            'label_attr' => [
                'class' => 'form-choice mt-2 mb-2 fw-bold'
            ],
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Invalid category !'
                ]),
            ]
        ])

        ->add('image', FileType::class, [
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
        ])
            
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-warning'
            ],
            'label' => 'Submit'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
