<?php

namespace App\Form;

use App\Entity\Entrainements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Regex;


class EntrainementsSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
            
            ->add('objectif', ChoiceType::class, [
                'label' => 'Objectif', // Étiquette pour ce champ
                'choices' => [
                    'Perte de poids' => 'Perte de poids',
                    'Se muscler' => 'Se muscler',
                ],
                'attr' => ['class' => 'form-control'], // Classes CSS pour le champ
            ])
            ->add('niveau', ChoiceType::class, [
                'label' => 'Niveau', // Étiquette pour ce champ
                'choices' => [
                    'Débutant' => 'Débutant',
                    'Avancé' => 'Avancé',
                    'Expert' => 'Expert',
                ],
                'attr' => ['class' => 'form-control'], // Classes CSS pour le champ
            ])
            ->add('periode', ChoiceType::class, [
                'label' => 'Période', // Étiquette pour ce champ
                'choices' => [
                    '1 jour par semaine' => '1',
                    '2 jours par semaine' => '2',
                    '3 jours par semaine' => '3',
                    '4 jours par semaine' => '4',
                    '5 jours par semaine' => '5',
                    '6 jours par semaine' => '6',
                ],
                'attr' => ['class' => 'form-control'], // Classes CSS pour le champ
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entrainements::class,
        ]);
    }
}