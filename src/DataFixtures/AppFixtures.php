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
        $familles = [];
        $classes = [];
        $ordres = [];
        $especes = [];
        for ($i = 1; $i <= 20; $i++) {
            $famille = new Famille();
            $famille->setNomFamille('Famille ' . $i);
            $manager->persist($famille);
            $familles[] = $famille;

            $classe = new Classe();
            $classe->setTypeClasse('Classe ' . $i);
            $manager->persist($classe);
            $classes[] = $classe;

            $ordre = new Ordre();
            $ordre->setTypeOrdre('Ordre ' . $i);
            $manager->persist($ordre);
            $ordres[] = $ordre;

            $espece = new Espece();
            $espece->setNomEspece('Espece ' . $i);
            $manager->persist($espece);
            $especes[] = $espece;
        }

        $cages = [];
        $allees = [];
        for ($i = 1; $i <= 20; $i++) {
            $cage = new Cage();
            $cage->setFonctionnalite('Fonctionnalite Cage ' . $i);
            $manager->persist($cage);
            $cages[] = $cage;

            $allee = new Allee();
            $allee->setNumeroAllee($i)
                ->setCage($cage);
            $manager->persist($allee);
            $allees[] = $allee;
        }

        $employes = [];
        $postes = [];
        for ($i = 1; $i <= 20; $i++) {
            $employe = new Employe();
            $employe->setNomEmploye('Employe ' . $i)
                ->setPrenomEmploye('Prenom ' . $i)
                ->setAge(20 + $i)
                ->setVille('Ville ' . $i)
                ->setSexe($i % 2 === 0 ? 'M' : 'F')
                ->setAllee($allees[($i - 1) % 20])
                ->setCage($cages[($i - 1) % 20]);
            $manager->persist($employe);
            $employes[] = $employe;

            $poste = new Poste();
            $poste->setNomPoste('Poste ' . $i)
                ->setEmploye($employe);
            $manager->persist($poste);
            $postes[] = $poste;
        }

        $aliments = [];
        for ($i = 1; $i <= 20; $i++) {
            $aliment = new Aliment();
            $aliment->setNomAliment('Aliment ' . $i);
            $manager->persist($aliment);
            $aliments[] = $aliment;
        }

        $compositions = [];
        for ($i = 1; $i <= 20; $i++) {
            $composition = new CompositionMenu();
            $composition->setQuantite(50 + $i * 2);
            $composition->addIdAliment($aliments[($i - 1) % 20]);
            $composition->addIdAliment($aliments[($i) % 20]);
            $manager->persist($composition);
            $compositions[] = $composition;
        }

        $menus = [];
        for ($i = 1; $i <= 20; $i++) {
            $menu = new Menu();
            $menu->setNomMenu('Menu ' . $i);
            $menu->addIdCompoMenu($compositions[($i - 1) % 20]);
            $menu->addIdCompoMenu($compositions[($i) % 20]);
            $manager->persist($menu);
            $menus[] = $menu;
        }

        $comportements = [];
        for ($i = 1; $i <= 20; $i++) {
            $comportement = new Comportement();
            $comportement->setTypeComportement('Comportement ' . $i);
            $manager->persist($comportement);
            $comportements[] = $comportement;
        }

        $maladies = [];
        for ($i = 1; $i <= 20; $i++) {
            $maladie = new ListeMaladie();
            $maladie->setNomMaladie('Maladie ' . $i);
            $manager->persist($maladie);
            $maladies[] = $maladie;
        }

        $vaccins = [];
        for ($i = 1; $i <= 20; $i++) {
            $vaccinListe = new ListeVaccin();
            $vaccinListe->setNomVaccin('Vaccin ' . $i);
            $manager->persist($vaccinListe);
            $vaccins[] = $vaccinListe;
        }

        $carnets = [];
        for ($i = 1; $i <= 20; $i++) {
            $carnet = new CarnetDeSante();
            $carnet->setNumeroCarnet($i);
            $manager->persist($carnet);
            $carnets[] = $carnet;
        }

        $animals = [];
        for ($i = 1; $i <= 20; $i++) {
            $animal = new Animal();
            $animal->setNomAnimal('Animal ' . $i)
                ->setOriginePays('Pays ' . $i)
                ->setNomPere('Pere ' . $i)
                ->setNomMere('Mere ' . $i)
                ->setRaceAnimal('Race ' . $i)
                ->setSexeAnimal($i % 2 === 0 ? 'M' : 'F')
                ->setDateNaissance(new \DateTime('2018-01-01 +' . ($i - 1) . ' days'))
                ->setDateArrivee(new \DateTime('2020-06-01 +' . ($i - 1) . ' days'))
                ->setIdCage($cages[($i - 1) % 20])
                ->setIdCarnet($carnets[($i - 1) % 20])
                ->setIdClasse($classes[($i - 1) % 20])
                ->setIdFamille($familles[($i - 1) % 20])
                ->setIdOrdre($ordres[($i - 1) % 20])
                ->setIdEspece($especes[($i - 1) % 20]);
            $animal->addIdMenu($menus[($i - 1) % 20]);
            $animal->addIdComportement($comportements[($i - 1) % 20]);
            $animal->addIdListeMaladie($maladies[($i - 1) % 20]);
            $manager->persist($animal);
            $animals[] = $animal;
        }

        $adoptants = [];
        for ($i = 1; $i <= 20; $i++) {
            $adoptant = new Adoptant();
            $adoptant->setNomAdoptant('Adoptant ' . $i)
                ->setPrenomAdoptant('PrenomAdoptant ' . $i)
                ->setAdresseAdoptant('Adresse ' . $i);

            $adoptant->addAnimal($animals[($i - 1) % 20]);
            $manager->persist($adoptant);
            $adoptants[] = $adoptant;
        }

        for ($i = 1; $i <= 20; $i++) {
            $adoptantAnimal = new AdoptantAnimal();
            $adoptantAnimal->setDateAdoption(new \DateTime('2023-01-01 +' . ($i - 1) . ' days'))
                ->setAdoptant($adoptants[($i - 1) % 20])
                ->setAnimal($animals[($i - 1) % 20]);
            $manager->persist($adoptantAnimal);
        }

        for ($i = 1; $i <= 20; $i++) {
            $vaccination = new Vaccination();
            $vaccination->setDateVaccination(new \DateTime('2023-01-10 +' . ($i - 1) . ' days'))
                ->setDateProchaineVaccination(new \DateTime('2024-01-10 +' . ($i - 1) . ' days'))
                ->setNumeroVaccination($i);
            $vaccination->addIdAnimal($animals[($i - 1) % 20]);
            $vaccination->addIdListeVaccin($vaccins[($i - 1) % 20]);
            $manager->persist($vaccination);
            $carnets[($i - 1) % 20]->addIdVaccination($vaccination);
            $carnets[($i - 1) % 20]->addIdMaladie($maladies[($i - 1) % 20]);
        }

        $manager->flush();
    }
}
