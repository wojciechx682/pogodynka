<?php

namespace App\Form;

use App\Entity\Measurement;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                // renders it as a single text box
                //'widget' => 'single_text',
            ])
            ->add('celsius')
            ->add('status', TextType::class)
            ->add('humidity', TextType::class)
            ->add('sunrise', TimeType::class)
            ->add('sunset', TimeType::class)
            ->add('windspeed', TextType::class)
            ->add('location')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurement::class,
        ]);
    }
}
