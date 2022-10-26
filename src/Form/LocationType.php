<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', ChoiceType::class, [
                'choices'  => [
                    'Szczecin' => 'Szczecin',
                    'Police' => 'Police',
                    'Berlin' => 'Berlin',
                ],
            ])
            ->add('country', ChoiceType::class, [
                'choices'  => [
                    'Polska' => 'PL',
                    'Niemcy' => 'DE',
                    'Czechy' => 'CZ',
                ],
            ])
            ->add('latitude', NumberType::class)
            ->add('longitude', NumberType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
