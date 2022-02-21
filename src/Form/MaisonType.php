<?php

namespace App\Form;

use App\Entity\Maison;
use App\Entity\Commercial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MaisonType extends AbstractType
{
    // ici dans l'espace admin créér une maison on rempli les champs du formulaire 
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'label' => 'Titre',
                'attr' => [
                    'maxLength' => 100,
                    'placeholder' => 'Exemple: Une jolie maison de campagne'
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => 'Description',
                'attr' => [
                    'maxLength' => 65535,
                    'placeholder' => 'Exemple: Un superbe appartement située non loin du coeur de la ville'
                ]
            ])
            ->add('surface', IntegerType::class, [
                'required' => true,
                'label' => 'Surface',
                'attr' => [
                    'min' => 0,
                    'max' => 999,
                    'placeholder' => 'Ex: 100'
                ]
            ])
            ->add('rooms', IntegerType::class, [
                'required' => true,
                'label' => 'Pièces',
                'attr' => [
                    'min' => 0,
                    'max' => 99,
                    'placeholder' => 'Ex: 8'
                ]
            ])
            ->add('bedrooms', IntegerType::class, [
                'required' => true,
                'label' => 'Chambres',
                'attr' => [
                    'min' => 0,
                    'max' => 99
                ]
            ])
            ->add('price', IntegerType::class, [
                'required' => true,
                'label' => 'Prix',
                'attr' => [
                    'min' => 0,
                    'max' => 9999999
                ]
            ])
            ->add('img1', FileType::class, [
                'required' => true,
                'label' => 'photo principale',
                'mapped' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '10M',
                        'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size }} Mo). Maximum autorisé : {{ limit }} Mo. ',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                            'image/jp2',
                            'image/webp',
                        ],
                    ])
                ]
            ])
            ->add('img2', FileType::class, [
                'required' => false,
                'label' => 'photo principale',
                'mapped' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '10M',
                        'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size }} Mo). Maximum autorisé : {{ limit }} Mo. ',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                            'image/jp2',
                            'image/webp',
                        ],
                    ])
                ]
            ])
            ->add('commercial', EntityType::class, [
                'class' => Commercial::class,
                'choice_label' => 'name'
            ])
            //->add('envoyer', SubmitType::class) // de préférence le mettre dans la vue 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Maison::class,
        ]);
    }
}
