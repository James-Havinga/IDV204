<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                
                'attr' => [
                    'class' => 'text-sm appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-askio-blue'
                ],
                'label_attr' => [
                    'class' => 'font-bold text-gray-900 text-sm mb-3'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'text-sm appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-askio-blue'
                ],
                'label_attr' => [
                    'class' => 'font-bold text-gray-900 text-sm mb-3'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class, 
                'required' => true,
                'first_options'  => [
                    'label' => 'Password',
                    'attr' => ['class' => 'mb-6 text-sm appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-askio-blue'],
                    'label_attr' => ['class' => 'font-bold text-gray-900 text-sm mb-3']
                ],
                'second_options' => [
                    'label' => 'Confirm Password', 
                    'attr' => ['class' => 'text-sm appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-askio-blue'],
                    'label_attr' => ['class' => 'font-bold text-gray-900 text-sm mb-3']
                ],
            ])
            ->add('image', FileType::class)
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'grow float-right bg-askio-blue cta-btn text-sm text-white py-2 px-10 rounded-full hover:shadow-lg focus:outline-none focus:shadow-outline'
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
