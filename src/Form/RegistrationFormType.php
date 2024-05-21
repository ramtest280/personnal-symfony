<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control mt-2'
                ]
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => 
                    [
                        'label' => 'Mot de passe',
                        'attr' => ['class' => 'form-control' ]       
                    ],
                'second_options' => 
                [
                    'label' => 'Confirmez votre de passe',
                    'attr' => ['class' => 'form-control']
                ],
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Mot de passe',
                    'class' => 'form-control' 
                ],
                
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le mot de passe doit etre compris entre 6 a 10000 caracteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    
                    
                ],
            ])
            
            ->add('nom' , TextType::class, [
                'attr' => [
                    'class' => 'form-control mt-2'
                ]
            ])

            ->add('avatar', FileType::class, [
                'label' => 'Avatar (Image file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '3000k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPEG/PNG)',
                    ])
                ],
                'attr' => [
                    'class' => 'form-control mt-2 mb-2' 
                ]
            ])    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
