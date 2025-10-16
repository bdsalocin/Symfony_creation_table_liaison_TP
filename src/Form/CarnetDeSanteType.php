<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\CarnetDeSante;
use App\Entity\ListeMaladie;
use App\Entity\Vaccination;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarnetDeSanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroCarnet')
            ->add('idVaccination', EntityType::class, [
                'class' => Vaccination::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('idMaladie', EntityType::class, [
                'class' => ListeMaladie::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('animal', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarnetDeSante::class,
        ]);
    }
}
