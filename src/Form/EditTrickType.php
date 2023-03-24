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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class EditTrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder 
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

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-lg btn-warning'
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
