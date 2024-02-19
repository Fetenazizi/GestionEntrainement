<?php

namespace App\Form;

use App\Entity\Exercices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Regex;

class ExercicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_exercice', TextType::class, [
                'label' => 'Nom de l\'exercice', // Étiquette pour ce champ
                'attr' => ['class' => 'form-control'], // Classes CSS pour le champ
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type', // Étiquette pour ce champ
                'choices' => [
                    'Cardio' => 'cardio',
                    'Abdos' => 'abdos',
                    'Cardio & Abdos' => 'cardio_abdos',
                    // Ajoutez d'autres types ici si nécessaire
                ],
                'placeholder' => 'Sélectionnez le type',
                'attr' => ['class' => 'form-control'], // Classes CSS pour le champ
            ])
            ->add('duree', TextType::class, [
                'label' => 'Durée', // Étiquette pour ce champ
                'attr' => ['class' => 'form-control'], // Classes CSS pour le champ
            ])
            ->add('nombres_de_fois', TextType::class, [
                'label' => 'Nombre de fois', // Étiquette pour ce champ
                'attr' => ['class' => 'form-control'], // Classes CSS pour le champ
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercices::class,
        ]);
    }
}
