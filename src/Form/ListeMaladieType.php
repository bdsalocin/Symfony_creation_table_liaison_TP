<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\CarnetDeSante;
use App\Entity\ListeMaladie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListeMaladieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomMaladie')
            ->add('carnetDeSantes', EntityType::class, [
                'class' => CarnetDeSante::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('animals', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('idCarnetDeSante', EntityType::class, [
                'class' => CarnetDeSante::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ListeMaladie::class,
        ]);
    }
}
