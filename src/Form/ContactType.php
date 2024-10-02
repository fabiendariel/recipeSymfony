<?php

namespace App\Form;

use App\DTO\ContactDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
              'label' => 'Nom complet',
              'empty_data' => ''
            ])
            ->add('email', EmailType::class, [
              'empty_data' => ''
            ])
            ->add('message', TextareaType::class, [
              'empty_data' => ''
            ])
            ->add('service', ChoiceType::class, [
              'choices' => [
                '' => 'contact@example.fr',
                'Compta' => 'compta@example.fr',
                'RH' => 'rh@example.fr',
                'Marketing' => 'marketing@example.fr',
              ]
            ])
            ->add('save', SubmitType::class, [
              'label' => 'Envoyer'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactDTO::class,
        ]);
    }
}
