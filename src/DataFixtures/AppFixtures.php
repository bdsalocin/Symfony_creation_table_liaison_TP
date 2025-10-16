<?php

namespace App\DataFixtures;

use App\Entity\Adoptant;
use App\Entity\AdoptantAnimal;
use App\Entity\Animal;
use App\Entity\Aliment;
use App\Entity\Allee;
use App\Entity\Cage;
use App\Entity\CarnetDeSante;
use App\Entity\Classe;
use App\Entity\Comportement;
use App\Entity\CompositionMenu;
use App\Entity\Employe;
use App\Entity\Espece;
use App\Entity\Famille;
use App\Entity\ListeMaladie;
use App\Entity\ListeVaccin;
use App\Entity\Menu;
use App\Entity\Ordre;
use App\Entity\Poste;
use App\Entity\Vaccination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // ------------------------------
        // Famille, Classe, Ordre, Espece
        // ------------------------------
        $famille = new Famille();
        $famille->setNomFamille('Felidae');
        $manager->persist($famille);

        $classe = new Classe();
        $classe->setTypeClasse('Mammifères');
        $manager->persist($classe);

        $ordre = new Ordre();
        $ordre->setTypeOrdre('Carnivores');
        $manager->persist($ordre);

        $espece = new Espece();
        $espece->setNomEspece('Lion');
        $manager->persist($espece);

        // ------------------------------
        // Cage et Allee
        // ------------------------------
        $cage = new Cage();
        $cage->setFonctionnalite('Zone Tropicale');
        $manager->persist($cage);

        $allee = new Allee();
        $allee->setNumeroAllee(1)
              ->setCage($cage);
        $manager->persist($allee);

        // ------------------------------
        // Employe et Poste
        // ------------------------------
        $employe = new Employe();
        $employe->setNomEmploye('Dupont')
                ->setPrenomEmploye('Jean')
                ->setAge(35)
                ->setVille('Paris')
                ->setSexe('M')
                ->setAllee($allee)
                ->setCage($cage);
        $manager->persist($employe);

        $poste = new Poste();
        $poste->setNomPoste('Soigneur')
              ->setEmploye($employe);
        $manager->persist($poste);

        // ------------------------------
        // Aliment et CompositionMenu
        // ------------------------------
        $aliment1 = new Aliment();
        $aliment1->setNomAliment('Croquettes');
        $manager->persist($aliment1);

        $aliment2 = new Aliment();
        $aliment2->setNomAliment('Foie');
        $manager->persist($aliment2);

        $composition = new CompositionMenu();
        $composition->setQuantite(100);
        $composition->addIdAliment($aliment1);
        $composition->addIdAliment($aliment2);
        $manager->persist($composition);

        // ------------------------------
        // Menu
        // ------------------------------
        $menu = new Menu();
        $menu->setNomMenu('Menu Principal');
        $menu->addIdCompoMenu($composition);
        $manager->persist($menu);

        // ------------------------------
        // Comportement
        // ------------------------------
        $comportement = new Comportement();
        $comportement->setTypeComportement('Sociable');
        $manager->persist($comportement);

        // ------------------------------
        // ListeMaladie et ListeVaccin
        // ------------------------------
        $maladie = new ListeMaladie();
        $maladie->setNomMaladie('Grippe');
        $manager->persist($maladie);

        $vaccinListe = new ListeVaccin();
        $vaccinListe->setNomVaccin('Tétanos');
        $manager->persist($vaccinListe);

        // ------------------------------
        // CarnetDeSante
        // ------------------------------
        $carnet = new CarnetDeSante();
        $carnet->setNumeroCarnet(1);
        $manager->persist($carnet);

        // ------------------------------
        // Animal
        // ------------------------------
        $animal = new Animal();
        $animal->setNomAnimal('Simba')
               ->setOriginePays('Kenya')
               ->setNomPere('Mufasa')
               ->setNomMere('Sarabi')
               ->setRaceAnimal('Lion')
               ->setSexeAnimal('M')
               ->setDateNaissance(new \DateTime('2018-01-01'))
               ->setDateArrivee(new \DateTime('2020-06-01'))
               ->setIdCage($cage)
               ->setIdCarnet($carnet)
               ->setIdClasse($classe)
               ->setIdFamille($famille)
               ->setIdOrdre($ordre)
               ->setIdEspece($espece);
        $animal->addIdMenu($menu);
        $animal->addIdComportement($comportement);
        $animal->addIdListeMaladie($maladie);
        $manager->persist($animal);

        // ------------------------------
        // Adoptant et liaison
        // ------------------------------
        $adoptant = new Adoptant();
        $adoptant->setNomAdoptant('Martin')
                 ->setPrenomAdoptant('Alice')
                 ->setAdresseAdoptant('123 Rue Exemple, Paris');
        $adoptant->addAnimal($animal);
        $manager->persist($adoptant);

        $adoptantAnimal = new AdoptantAnimal();
        $adoptantAnimal->setDateAdoption(new \DateTime('2023-01-01'))
                       ->setAdoptant($adoptant)
                       ->setAnimal($animal);
        $manager->persist($adoptantAnimal);

        // ------------------------------
        // Vaccination
        // ------------------------------
        $vaccination = new Vaccination();
        $vaccination->setDateVaccination(new \DateTime('2023-01-10'))
                    ->setDateProchaineVaccination(new \DateTime('2024-01-10'))
                    ->setNumeroVaccination(1);
        $vaccination->addIdAnimal($animal);
        $vaccination->addIdListeVaccin($vaccinListe);
        $manager->persist($vaccination);

        // Relier carnet à la vaccination
        $carnet->addIdVaccination($vaccination);
        $carnet->addIdMaladie($maladie);

        // ------------------------------
        // Flush final
        // ------------------------------
        $manager->flush();
    }
}