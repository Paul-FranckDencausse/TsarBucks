<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class RegistrationFormType extends AbstractType

{   
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
           
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre nom.']),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre prénom.']),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Adresse email',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir une adresse email.']),
                    new \Symfony\Component\Validator\Constraints\Email([
                        'message' => 'Veuillez saisir une adresse email valide.',
                    ]),
                ],
            ])
            
            ->add('gender', ChoiceType::class, [
                'label' => 'Genre',
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                  
                    'Préfère ne pas répondre' => 'NA',
                ],
                'placeholder' => 'Sélectionnez votre genre',
                'attr' => ['class' => 'form-select'],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez sélectionner un genre.']),
                ],
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'max' => 15,
                        'minMessage' => 'Le numéro de téléphone doit comporter au moins {{ limit }} chiffres.',
                    ]),
                    new \Symfony\Component\Validator\Constraints\Regex([
                        'pattern' => '/^\+?[0-9]+$/',
                        'message' => 'Veuillez saisir un numéro de téléphone valide.',
                    ]),
                ],
            ])
            
           
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('PostalCode', TextType::class, [
                'label' => 'Code Postal',
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Length(['max' => 10]),
                    new \Symfony\Component\Validator\Constraints\Regex([
                        'pattern' => '/^\d{5}$/',
                        'message' => 'Veuillez saisir un code postal valide (5 chiffres).',
                    ]),
                ],
            ])
            
            ->add('City', TextType::class, [
                'label' => 'Ville',
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Length(['max' => 100]),
                    new \Symfony\Component\Validator\Constraints\Regex([
                        'pattern' => '/^[a-zA-ZÀ-ÿ\s-]+$/',
                        'message' => 'Veuillez saisir une ville valide.',
                    ]),
                ],
            ])
            
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'J\'accepte les conditions générales',
                'mapped' => false,
                'row_attr' => ['class' => 'form-check'],
                'attr' => ['class' => 'form-check-input'],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions générales.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'required' => true,
                'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir un mot de passe.']),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères.',
                        'max' => 25,
                    ]),
                    new \Symfony\Component\Validator\Constraints\Regex([
                        'pattern' => '/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W]).{8,}/',
                        'message' => 'Votre mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.',
                    ]),
                ],
            ]);
    }

   
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'user_registration',
        ]);
    }
}
