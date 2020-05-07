<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200507133149 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE mesures_peseruches');
        $this->addSql('DROP TABLE mesures_ruchers');
        $this->addSql('ALTER TABLE mesures_ruches ADD peseruche_id INT NOT NULL');
        $this->addSql('ALTER TABLE mesures_ruches ADD CONSTRAINT FK_FFE2624A9769B49B FOREIGN KEY (peseruche_id) REFERENCES cpese_ruche (id)');
        $this->addSql('CREATE INDEX IDX_FFE2624A9769B49B ON mesures_ruches (peseruche_id)');
        $this->addSql('ALTER TABLE mesures_stations ADD rucher_id INT NOT NULL');
        $this->addSql('ALTER TABLE mesures_stations ADD CONSTRAINT FK_76E19478BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
        $this->addSql('CREATE INDEX IDX_76E19478BF1374E ON mesures_stations (rucher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mesures_peseruches (id INT AUTO_INCREMENT NOT NULL, peseruche_id INT NOT NULL, poids SMALLINT NOT NULL, date_releve DATETIME NOT NULL, INDEX IDX_45EF7EDD9769B49B (peseruche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mesures_ruchers (id INT AUTO_INCREMENT NOT NULL, rucher_id INT NOT NULL, station_id INT NOT NULL, temperature SMALLINT NOT NULL, tension SMALLINT NOT NULL, humidite SMALLINT NOT NULL, pression SMALLINT NOT NULL, date_releve DATETIME NOT NULL, INDEX IDX_94E3B4A68BF1374E (rucher_id), INDEX IDX_94E3B4A621BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE mesures_peseruches ADD CONSTRAINT FK_45EF7EDD9769B49B FOREIGN KEY (peseruche_id) REFERENCES cpese_ruche (id)');
        $this->addSql('ALTER TABLE mesures_ruchers ADD CONSTRAINT FK_94E3B4A621BDB235 FOREIGN KEY (station_id) REFERENCES cstation (id)');
        $this->addSql('ALTER TABLE mesures_ruchers ADD CONSTRAINT FK_94E3B4A68BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
        $this->addSql('ALTER TABLE mesures_ruches DROP FOREIGN KEY FK_FFE2624A9769B49B');
        $this->addSql('DROP INDEX IDX_FFE2624A9769B49B ON mesures_ruches');
        $this->addSql('ALTER TABLE mesures_ruches DROP peseruche_id');
        $this->addSql('ALTER TABLE mesures_stations DROP FOREIGN KEY FK_76E19478BF1374E');
        $this->addSql('DROP INDEX IDX_76E19478BF1374E ON mesures_stations');
        $this->addSql('ALTER TABLE mesures_stations DROP rucher_id');
    }
}
