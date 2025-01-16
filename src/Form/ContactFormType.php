<?php
// src/Form/ContactFormType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      
$builder
->add('email', EmailType::class, ['label' => 'Email'])
->add('subject', TextType::class, ['label' => 'Sujet'])
->add('message', TextareaType::class, ['label' => 'Message'])
->add('salon', ChoiceType::class, [
    'label' => 'Salon',
    'choices' => [
        'Stalingrad' => 'salon_a',
        'Ivan le Terrible' => 'salon_b',
        'Catherine II' => 'salon_c',
        'URSS' => 'salon_d',
        'Anastasia Romanov' => 'salon_e',
        'Raspoutine' => 'salon_f',
    ],
    'placeholder' => 'Choisissez un salon', // Optionnel
]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
