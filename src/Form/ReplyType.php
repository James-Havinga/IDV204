<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class ReplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reply', TextType::class, [
                'attr' => [
                    'class' => 'form-control text-sm appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-askio-blue'
                ]
            ])
            ->add('comment', HiddenType::class)
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'form-sub py-2 px-3 grow-small ml-2 bg-askio-blue text-sm text-white rounded-full hover:shadow-lg focus:outline-none focus:shadow-outline'
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
