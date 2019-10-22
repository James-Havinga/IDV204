<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', TextType::class, [
                'attr' => [
                    'placeholder' => 'Tell us what you think',
                    'class' => 'h-12 text-top text-sm border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-askio-blue'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'mt-4 float-right grow-small bg-askio-blue text-sm text-white py-2 px-4 rounded-full hover:shadow-lg focus:outline-none focus:shadow-outline'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
