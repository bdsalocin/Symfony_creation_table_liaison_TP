<?php

namespace App\Form;

use App\Entity\Allee;
use App\Entity\Cage;
use App\Entity\Employe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEmploye')
            ->add('prenomEmploye')
            ->add('ville')
            ->add('age')
            ->add('sexe')
            ->add('allee', EntityType::class, [
                'class' => Allee::class,
                'choice_label' => 'id',
            ])
            ->add('cage', EntityType::class, [
                'class' => Cage::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
