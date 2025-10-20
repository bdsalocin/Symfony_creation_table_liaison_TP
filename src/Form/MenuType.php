<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\CompositionMenu;
use App\Entity\Menu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomMenu')
            ->add('animals', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('idCompoMenu', EntityType::class, [
                'class' => CompositionMenu::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
