<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200411124252 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE capiculteur MODIFY id_api SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE capiculteur DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE capiculteur CHANGE id_api id SMALLINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE capiculteur ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE cpese_ruche ADD proprietaire_id SMALLINT NOT NULL, ADD rucher_id INT NOT NULL, ADD humidite_inter SMALLINT DEFAULT NULL, ADD humidite_exter SMALLINT DEFAULT NULL, ADD temp_inter SMALLINT DEFAULT NULL, ADD temp_exter SMALLINT DEFAULT NULL, ADD luminosite SMALLINT DEFAULT NULL, ADD niv_eau SMALLINT DEFAULT NULL, ADD date_install DATE DEFAULT NULL, ADD date_releve DATETIME DEFAULT NULL, ADD type_ruche VARCHAR(15) DEFAULT NULL');
        $this->addSql('ALTER TABLE cpese_ruche ADD CONSTRAINT FK_411BADB576C50E4A FOREIGN KEY (proprietaire_id) REFERENCES capiculteur (id)');
        $this->addSql('ALTER TABLE cpese_ruche ADD CONSTRAINT FK_411BADB58BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
        $this->addSql('CREATE INDEX IDX_411BADB576C50E4A ON cpese_ruche (proprietaire_id)');
        $this->addSql('CREATE INDEX IDX_411BADB58BF1374E ON cpese_ruche (rucher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE capiculteur MODIFY id SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE capiculteur DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE capiculteur CHANGE id id_api SMALLINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE capiculteur ADD PRIMARY KEY (id_api)');
        $this->addSql('ALTER TABLE cpese_ruche DROP FOREIGN KEY FK_411BADB576C50E4A');
        $this->addSql('ALTER TABLE cpese_ruche DROP FOREIGN KEY FK_411BADB58BF1374E');
        $this->addSql('DROP INDEX IDX_411BADB576C50E4A ON cpese_ruche');
        $this->addSql('DROP INDEX IDX_411BADB58BF1374E ON cpese_ruche');
        $this->addSql('ALTER TABLE cpese_ruche DROP proprietaire_id, DROP rucher_id, DROP humidite_inter, DROP humidite_exter, DROP temp_inter, DROP temp_exter, DROP luminosite, DROP niv_eau, DROP date_install, DROP date_releve, DROP type_ruche');
    }
}
