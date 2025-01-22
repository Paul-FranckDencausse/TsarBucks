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
                ],
            ])
            ->add('City', TextType::class, [
                'label' => 'Ville',
                'required' => false,
                'attr' => ['class' => 'form-control'],
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
                'mapped' => false, // Indique que ce champ n'est pas mappé directement à une propriété de l'entité
                'required' => true,
                'label' => 'Password',
            ])
            ->add('accordParental', CheckboxType::class, [
                'label' => 'J\'atteste avoir obtenu l\'accord parental (si mineur)',
                'mapped' => false,
                'required' => false,
                'row_attr' => ['class' => 'form-check'],
                'attr' => ['class' => 'form-check-input'],
                'constraints' => [
                    new Callback([$this, 'validateParentalConsent']),
                ],
            ]);
    }

    public function validateAge($value, ExecutionContextInterface $context): void
    {
        $today = new \DateTime();
        $age = $today->diff($value)->y;

        if ($age < 16) {
            $context->buildViolation('Vous devez avoir au moins 16 ans pour vous inscrire.')
                ->addViolation();
        }
    }

    public function validateParentalConsent($value, ExecutionContextInterface $context): void
    {
        if ($value === null) {
            $context->buildViolation('Vous devez cocher cette case si vous êtes mineur.')
                ->addViolation();
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
