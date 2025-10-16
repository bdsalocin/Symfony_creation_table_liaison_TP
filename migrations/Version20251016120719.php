<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251016120719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adoptant (id INT AUTO_INCREMENT NOT NULL, nom_adoptant VARCHAR(50) NOT NULL, prenom_adoptant VARCHAR(50) NOT NULL, adresse_adoptant VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adoptant_animal (id INT AUTO_INCREMENT NOT NULL, adoptant_id INT NOT NULL, animal_id INT NOT NULL, date_adoption DATE DEFAULT NULL, INDEX IDX_763F83C08D8B49F9 (adoptant_id), INDEX IDX_763F83C08E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE aliment (id INT AUTO_INCREMENT NOT NULL, nom_aliment VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE allee (id INT AUTO_INCREMENT NOT NULL, cage_id INT DEFAULT NULL, numero_allee INT NOT NULL, INDEX IDX_771FD92A5A70E5B7 (cage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, id_cage_id INT NOT NULL, id_carnet_id INT NOT NULL, id_espece_id INT NOT NULL, id_famille_id INT NOT NULL, id_classe_id INT NOT NULL, id_ordre_id INT NOT NULL, nom_animal VARCHAR(50) NOT NULL, origine_pays VARCHAR(50) NOT NULL, date_naissance DATE NOT NULL, date_arrivee DATE NOT NULL, nom_pere VARCHAR(50) NOT NULL, nom_mere VARCHAR(50) NOT NULL, race_animal VARCHAR(50) NOT NULL, sexe_animal VARCHAR(8) NOT NULL, INDEX IDX_6AAB231F84ED4CC7 (id_cage_id), UNIQUE INDEX UNIQ_6AAB231F7A15C931 (id_carnet_id), INDEX IDX_6AAB231FAD2CA25D (id_espece_id), INDEX IDX_6AAB231F322DFB53 (id_famille_id), INDEX IDX_6AAB231FF6B192E (id_classe_id), INDEX IDX_6AAB231FC24AA519 (id_ordre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal_menu (animal_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_3A287BA78E962C16 (animal_id), INDEX IDX_3A287BA7CCD7E912 (menu_id), PRIMARY KEY(animal_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal_liste_maladie (animal_id INT NOT NULL, liste_maladie_id INT NOT NULL, INDEX IDX_3623AB3F8E962C16 (animal_id), INDEX IDX_3623AB3FA65B5E01 (liste_maladie_id), PRIMARY KEY(animal_id, liste_maladie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal_comportement (animal_id INT NOT NULL, comportement_id INT NOT NULL, INDEX IDX_198EF6618E962C16 (animal_id), INDEX IDX_198EF661DE9F7622 (comportement_id), PRIMARY KEY(animal_id, comportement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal_adoptant (animal_id INT NOT NULL, adoptant_id INT NOT NULL, INDEX IDX_C13729F78E962C16 (animal_id), INDEX IDX_C13729F78D8B49F9 (adoptant_id), PRIMARY KEY(animal_id, adoptant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cage (id INT AUTO_INCREMENT NOT NULL, fonctionnalite VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carnet_de_sante (id INT AUTO_INCREMENT NOT NULL, numero_carnet INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carnet_de_sante_vaccination (carnet_de_sante_id INT NOT NULL, vaccination_id INT NOT NULL, INDEX IDX_3DE343DA8B20F9C8 (carnet_de_sante_id), INDEX IDX_3DE343DA4DDCCFA3 (vaccination_id), PRIMARY KEY(carnet_de_sante_id, vaccination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carnet_de_sante_liste_maladie (carnet_de_sante_id INT NOT NULL, liste_maladie_id INT NOT NULL, INDEX IDX_A1AC9BFC8B20F9C8 (carnet_de_sante_id), INDEX IDX_A1AC9BFCA65B5E01 (liste_maladie_id), PRIMARY KEY(carnet_de_sante_id, liste_maladie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, type_classe VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comportement (id INT AUTO_INCREMENT NOT NULL, type_comportement VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composition_menu (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composition_menu_aliment (composition_menu_id INT NOT NULL, aliment_id INT NOT NULL, INDEX IDX_529A5C74D1A0FE6A (composition_menu_id), INDEX IDX_529A5C74415B9F11 (aliment_id), PRIMARY KEY(composition_menu_id, aliment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, allee_id INT DEFAULT NULL, cage_id INT DEFAULT NULL, nom_employe VARCHAR(50) NOT NULL, prenom_employe VARCHAR(50) NOT NULL, ville VARCHAR(50) NOT NULL, age INT NOT NULL, sexe VARCHAR(50) NOT NULL, INDEX IDX_F804D3B98E6975D2 (allee_id), INDEX IDX_F804D3B95A70E5B7 (cage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE espece (id INT AUTO_INCREMENT NOT NULL, nom_espece VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famille (id INT AUTO_INCREMENT NOT NULL, nom_famille VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_maladie (id INT AUTO_INCREMENT NOT NULL, nom_maladie VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_maladie_carnet_de_sante (liste_maladie_id INT NOT NULL, carnet_de_sante_id INT NOT NULL, INDEX IDX_A017029A65B5E01 (liste_maladie_id), INDEX IDX_A0170298B20F9C8 (carnet_de_sante_id), PRIMARY KEY(liste_maladie_id, carnet_de_sante_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_vaccin (id INT AUTO_INCREMENT NOT NULL, nom_vaccin VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, nom_menu VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_composition_menu (menu_id INT NOT NULL, composition_menu_id INT NOT NULL, INDEX IDX_8C75A79CCCD7E912 (menu_id), INDEX IDX_8C75A79CD1A0FE6A (composition_menu_id), PRIMARY KEY(menu_id, composition_menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordre (id INT AUTO_INCREMENT NOT NULL, type_ordre VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (id INT AUTO_INCREMENT NOT NULL, employe_id INT DEFAULT NULL, nom_poste VARCHAR(15) NOT NULL, INDEX IDX_7C890FAB1B65292 (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaccination (id INT AUTO_INCREMENT NOT NULL, date_vaccination DATE NOT NULL, date_prochaine_vaccination DATE NOT NULL, numero_vaccination INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaccination_liste_vaccin (vaccination_id INT NOT NULL, liste_vaccin_id INT NOT NULL, INDEX IDX_187BC2074DDCCFA3 (vaccination_id), INDEX IDX_187BC207C6606A2F (liste_vaccin_id), PRIMARY KEY(vaccination_id, liste_vaccin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaccination_animal (vaccination_id INT NOT NULL, animal_id INT NOT NULL, INDEX IDX_59A902174DDCCFA3 (vaccination_id), INDEX IDX_59A902178E962C16 (animal_id), PRIMARY KEY(vaccination_id, animal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adoptant_animal ADD CONSTRAINT FK_763F83C08D8B49F9 FOREIGN KEY (adoptant_id) REFERENCES adoptant (id)');
        $this->addSql('ALTER TABLE adoptant_animal ADD CONSTRAINT FK_763F83C08E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE allee ADD CONSTRAINT FK_771FD92A5A70E5B7 FOREIGN KEY (cage_id) REFERENCES cage (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F84ED4CC7 FOREIGN KEY (id_cage_id) REFERENCES cage (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F7A15C931 FOREIGN KEY (id_carnet_id) REFERENCES carnet_de_sante (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FAD2CA25D FOREIGN KEY (id_espece_id) REFERENCES espece (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F322DFB53 FOREIGN KEY (id_famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FF6B192E FOREIGN KEY (id_classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FC24AA519 FOREIGN KEY (id_ordre_id) REFERENCES ordre (id)');
        $this->addSql('ALTER TABLE animal_menu ADD CONSTRAINT FK_3A287BA78E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_menu ADD CONSTRAINT FK_3A287BA7CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_liste_maladie ADD CONSTRAINT FK_3623AB3F8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_liste_maladie ADD CONSTRAINT FK_3623AB3FA65B5E01 FOREIGN KEY (liste_maladie_id) REFERENCES liste_maladie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_comportement ADD CONSTRAINT FK_198EF6618E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_comportement ADD CONSTRAINT FK_198EF661DE9F7622 FOREIGN KEY (comportement_id) REFERENCES comportement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_adoptant ADD CONSTRAINT FK_C13729F78E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_adoptant ADD CONSTRAINT FK_C13729F78D8B49F9 FOREIGN KEY (adoptant_id) REFERENCES adoptant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carnet_de_sante_vaccination ADD CONSTRAINT FK_3DE343DA8B20F9C8 FOREIGN KEY (carnet_de_sante_id) REFERENCES carnet_de_sante (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carnet_de_sante_vaccination ADD CONSTRAINT FK_3DE343DA4DDCCFA3 FOREIGN KEY (vaccination_id) REFERENCES vaccination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carnet_de_sante_liste_maladie ADD CONSTRAINT FK_A1AC9BFC8B20F9C8 FOREIGN KEY (carnet_de_sante_id) REFERENCES carnet_de_sante (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carnet_de_sante_liste_maladie ADD CONSTRAINT FK_A1AC9BFCA65B5E01 FOREIGN KEY (liste_maladie_id) REFERENCES liste_maladie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composition_menu_aliment ADD CONSTRAINT FK_529A5C74D1A0FE6A FOREIGN KEY (composition_menu_id) REFERENCES composition_menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composition_menu_aliment ADD CONSTRAINT FK_529A5C74415B9F11 FOREIGN KEY (aliment_id) REFERENCES aliment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B98E6975D2 FOREIGN KEY (allee_id) REFERENCES allee (id)');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B95A70E5B7 FOREIGN KEY (cage_id) REFERENCES cage (id)');
        $this->addSql('ALTER TABLE liste_maladie_carnet_de_sante ADD CONSTRAINT FK_A017029A65B5E01 FOREIGN KEY (liste_maladie_id) REFERENCES liste_maladie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_maladie_carnet_de_sante ADD CONSTRAINT FK_A0170298B20F9C8 FOREIGN KEY (carnet_de_sante_id) REFERENCES carnet_de_sante (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_composition_menu ADD CONSTRAINT FK_8C75A79CCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_composition_menu ADD CONSTRAINT FK_8C75A79CD1A0FE6A FOREIGN KEY (composition_menu_id) REFERENCES composition_menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FAB1B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE vaccination_liste_vaccin ADD CONSTRAINT FK_187BC2074DDCCFA3 FOREIGN KEY (vaccination_id) REFERENCES vaccination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vaccination_liste_vaccin ADD CONSTRAINT FK_187BC207C6606A2F FOREIGN KEY (liste_vaccin_id) REFERENCES liste_vaccin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vaccination_animal ADD CONSTRAINT FK_59A902174DDCCFA3 FOREIGN KEY (vaccination_id) REFERENCES vaccination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vaccination_animal ADD CONSTRAINT FK_59A902178E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adoptant_animal DROP FOREIGN KEY FK_763F83C08D8B49F9');
        $this->addSql('ALTER TABLE adoptant_animal DROP FOREIGN KEY FK_763F83C08E962C16');
        $this->addSql('ALTER TABLE allee DROP FOREIGN KEY FK_771FD92A5A70E5B7');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F84ED4CC7');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F7A15C931');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FAD2CA25D');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F322DFB53');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FF6B192E');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FC24AA519');
        $this->addSql('ALTER TABLE animal_menu DROP FOREIGN KEY FK_3A287BA78E962C16');
        $this->addSql('ALTER TABLE animal_menu DROP FOREIGN KEY FK_3A287BA7CCD7E912');
        $this->addSql('ALTER TABLE animal_liste_maladie DROP FOREIGN KEY FK_3623AB3F8E962C16');
        $this->addSql('ALTER TABLE animal_liste_maladie DROP FOREIGN KEY FK_3623AB3FA65B5E01');
        $this->addSql('ALTER TABLE animal_comportement DROP FOREIGN KEY FK_198EF6618E962C16');
        $this->addSql('ALTER TABLE animal_comportement DROP FOREIGN KEY FK_198EF661DE9F7622');
        $this->addSql('ALTER TABLE animal_adoptant DROP FOREIGN KEY FK_C13729F78E962C16');
        $this->addSql('ALTER TABLE animal_adoptant DROP FOREIGN KEY FK_C13729F78D8B49F9');
        $this->addSql('ALTER TABLE carnet_de_sante_vaccination DROP FOREIGN KEY FK_3DE343DA8B20F9C8');
        $this->addSql('ALTER TABLE carnet_de_sante_vaccination DROP FOREIGN KEY FK_3DE343DA4DDCCFA3');
        $this->addSql('ALTER TABLE carnet_de_sante_liste_maladie DROP FOREIGN KEY FK_A1AC9BFC8B20F9C8');
        $this->addSql('ALTER TABLE carnet_de_sante_liste_maladie DROP FOREIGN KEY FK_A1AC9BFCA65B5E01');
        $this->addSql('ALTER TABLE composition_menu_aliment DROP FOREIGN KEY FK_529A5C74D1A0FE6A');
        $this->addSql('ALTER TABLE composition_menu_aliment DROP FOREIGN KEY FK_529A5C74415B9F11');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B98E6975D2');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B95A70E5B7');
        $this->addSql('ALTER TABLE liste_maladie_carnet_de_sante DROP FOREIGN KEY FK_A017029A65B5E01');
        $this->addSql('ALTER TABLE liste_maladie_carnet_de_sante DROP FOREIGN KEY FK_A0170298B20F9C8');
        $this->addSql('ALTER TABLE menu_composition_menu DROP FOREIGN KEY FK_8C75A79CCCD7E912');
        $this->addSql('ALTER TABLE menu_composition_menu DROP FOREIGN KEY FK_8C75A79CD1A0FE6A');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY FK_7C890FAB1B65292');
        $this->addSql('ALTER TABLE vaccination_liste_vaccin DROP FOREIGN KEY FK_187BC2074DDCCFA3');
        $this->addSql('ALTER TABLE vaccination_liste_vaccin DROP FOREIGN KEY FK_187BC207C6606A2F');
        $this->addSql('ALTER TABLE vaccination_animal DROP FOREIGN KEY FK_59A902174DDCCFA3');
        $this->addSql('ALTER TABLE vaccination_animal DROP FOREIGN KEY FK_59A902178E962C16');
        $this->addSql('DROP TABLE adoptant');
        $this->addSql('DROP TABLE adoptant_animal');
        $this->addSql('DROP TABLE aliment');
        $this->addSql('DROP TABLE allee');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE animal_menu');
        $this->addSql('DROP TABLE animal_liste_maladie');
        $this->addSql('DROP TABLE animal_comportement');
        $this->addSql('DROP TABLE animal_adoptant');
        $this->addSql('DROP TABLE cage');
        $this->addSql('DROP TABLE carnet_de_sante');
        $this->addSql('DROP TABLE carnet_de_sante_vaccination');
        $this->addSql('DROP TABLE carnet_de_sante_liste_maladie');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE comportement');
        $this->addSql('DROP TABLE composition_menu');
        $this->addSql('DROP TABLE composition_menu_aliment');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE espece');
        $this->addSql('DROP TABLE famille');
        $this->addSql('DROP TABLE liste_maladie');
        $this->addSql('DROP TABLE liste_maladie_carnet_de_sante');
        $this->addSql('DROP TABLE liste_vaccin');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_composition_menu');
        $this->addSql('DROP TABLE ordre');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE vaccination');
        $this->addSql('DROP TABLE vaccination_liste_vaccin');
        $this->addSql('DROP TABLE vaccination_animal');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
