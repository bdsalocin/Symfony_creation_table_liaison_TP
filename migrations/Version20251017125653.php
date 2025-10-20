<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251017125653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal_adoptant DROP FOREIGN KEY FK_C13729F78D8B49F9');
        $this->addSql('ALTER TABLE animal_adoptant DROP FOREIGN KEY FK_C13729F78E962C16');
        $this->addSql('DROP TABLE animal_adoptant');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F7A15C931');
        $this->addSql('ALTER TABLE animal ADD id_adoptant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F9599840E FOREIGN KEY (id_adoptant_id) REFERENCES adoptant (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F7A15C931 FOREIGN KEY (id_carnet_id) REFERENCES carnet_de_sante (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_6AAB231F9599840E ON animal (id_adoptant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal_adoptant (animal_id INT NOT NULL, adoptant_id INT NOT NULL, INDEX IDX_C13729F78E962C16 (animal_id), INDEX IDX_C13729F78D8B49F9 (adoptant_id), PRIMARY KEY(animal_id, adoptant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE animal_adoptant ADD CONSTRAINT FK_C13729F78D8B49F9 FOREIGN KEY (adoptant_id) REFERENCES adoptant (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_adoptant ADD CONSTRAINT FK_C13729F78E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F9599840E');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F7A15C931');
        $this->addSql('DROP INDEX IDX_6AAB231F9599840E ON animal');
        $this->addSql('ALTER TABLE animal DROP id_adoptant_id');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F7A15C931 FOREIGN KEY (id_carnet_id) REFERENCES carnet_de_sante (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
