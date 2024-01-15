<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Votre nom',
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'prenom',
                'attr' => [
                    'placeholder' => 'Votre prénom',
                ],
            ])
            ->add('diplome', TextType::class, [
                'label' => 'diplome',
                'attr' => [
                    'placeholder' => 'Votre niveau d\'étude',
                ],
            ])
            ->add('entreprise', TextType::class, [
                'label' => 'entreprise',
                'attr' => [
                    'placeholder' => 'Entreprise',
                ],
            ])
            ->add('poste', TextType::class, [
                'label' => 'poste',
                'attr' => [
                    'placeholder' => 'Poste',
                ],
            ])
            ->add('annonce', TextType::class, [
                'label' => 'annonce',
                'attr' => [
                    'placeholder' => 'Annonce',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
