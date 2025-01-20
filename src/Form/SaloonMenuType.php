<?php
// src/Form/SaloonMenuType.php

namespace App\Form;

use App\Entity\SaloonMenu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class SaloonMenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('saloon_id', NumberType::class, [
                'label' => 'ID du salon',
            ])
            ->add('menu_id', NumberType::class, [
                'label' => 'ID du menu',
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom du menu',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('type', TextType::class, [
                'label' => 'Type',
            ])
            ->add('recipeId', NumberType::class, [
                'label' => 'ID de la recette',
                'required' => false,
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix',
                'required' => false,
            ])
            ->add('mediaFile', FileType::class, [
                'label' => 'Image',
                'mapped' => false, // Ce champ ne sera pas mappé à une propriété de l'entité
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (jpeg, png, gif)',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SaloonMenu::class,
        ]);
    }
}
