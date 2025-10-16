<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\CarnetDeSante;
use App\Entity\ListeVaccin;
use App\Entity\Vaccination;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VaccinationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateVaccination')
            ->add('dateProchaineVaccination')
            ->add('numeroVaccination')
            ->add('carnetDeSantes', EntityType::class, [
                'class' => CarnetDeSante::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('idListeVaccin', EntityType::class, [
                'class' => ListeVaccin::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('idAnimal', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vaccination::class,
        ]);
    }
}
