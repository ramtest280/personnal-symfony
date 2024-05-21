<?php

namespace App\Form;

use App\Entity\Tuto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


class TutoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Auteur', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('images', FileType::class, [
                'label' => 'Tuto (Image File)',
                'mapped' => false,
                'required' => true,
                
            ])
        ;
         
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tuto::class,
        ]);
    }
}
