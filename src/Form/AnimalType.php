<?php

namespace App\Form;

use App\Entity\Adoptant;
use App\Entity\Animal;
use App\Entity\Cage;
use App\Entity\CarnetDeSante;
use App\Entity\Classe;
use App\Entity\Comportement;
use App\Entity\Espece;
use App\Entity\Famille;
use App\Entity\ListeMaladie;
use App\Entity\Menu;
use App\Entity\Ordre;
use App\Entity\Vaccination;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAnimal')
            ->add('originePays')
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('dateArrivee', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('nomPere')
            ->add('nomMere')
            ->add('raceAnimal')
            ->add('sexeAnimal')
            ->add('vaccinations', EntityType::class, [
                'class' => Vaccination::class,
                'choice_label' => function ($vaccination) {
                    return $vaccination->getDateVaccination() ? $vaccination->getDateVaccination()->format('Y-m-d') : '';
                },
                'multiple' => true,
            ])
            ->add('idMenu', EntityType::class, [
                'class' => Menu::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('idCage', EntityType::class, [
                'class' => Cage::class,
                'choice_label' => 'id',
            ])
            ->add('idCarnet', EntityType::class, [
                'class' => CarnetDeSante::class,
                'choice_label' => 'id',
            ])
            ->add('idEspece', EntityType::class, [
                'class' => Espece::class,
                'choice_label' => 'id',
            ])
            ->add('idFamille', EntityType::class, [
                'class' => Famille::class,
                'choice_label' => 'id',
            ])
            ->add('idClasse', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'id',
            ])
            ->add('idOrdre', EntityType::class, [
                'class' => Ordre::class,
                'choice_label' => 'id',
            ])
            ->add('idListeMaladie', EntityType::class, [
                'class' => ListeMaladie::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('idComportement', EntityType::class, [
                'class' => Comportement::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('idAdoptant', EntityType::class, [
                'class' => Adoptant::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
