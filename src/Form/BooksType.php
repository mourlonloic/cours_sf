<?php

namespace App\Form;

use App\Entity\Books;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BooksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /* Book Title*/
            ->add('title', TextType::class, [
                "label" => "Titre du livre",
                "help" => "Saisir le titre du livre",

                "required" => true,

                'attr' => [
                    'class' => "form_control"
                ],

                'label_attr' => [
                    "class" => "col-4"
                ]
            ])

            /* Book Description */
            ->add('description', TextareaType::class, [
                "label" => "Description du livre",
                "help" => "Saisir la description du livre",

                "required" => false,

                'attr' => [
                    'class' => "form_control"
                ],
                
                'label_attr' => [
                    "class" => "col-4"
                ]

            ])

            /* Book price */
            ->add('price', NumberType::class, [
                "label" => "Prix du livre",
                "help" => "Saisir le prix du livre",

                "required" => true,

                'attr' => [
                    'class' => "form_control"
                ],
                
                'label_attr' => [
                    "class" => "col-4"
                ]

            ])

            /* Book cover */
            // ->add('cover')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
        ]);
    }
}
