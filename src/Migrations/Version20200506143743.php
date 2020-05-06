<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506143743 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        #$this->addSql('ALTER TABLE cpese_ruche ADD CONSTRAINT FK_411BADB562554C91 FOREIGN KEY (association_peseruche_station_id) REFERENCES association_peseruche_station (id)');
        $this->addSql('ALTER TABLE cruche ADD association_ruche_rucher_id INT NOT NULL');
        $this->addSql('ALTER TABLE cruche ADD CONSTRAINT FK_3A3C3E574DE0AFF5 FOREIGN KEY (association_ruche_rucher_id) REFERENCES association_ruche_rucher (id)');
        $this->addSql('CREATE INDEX IDX_3A3C3E574DE0AFF5 ON cruche (association_ruche_rucher_id)');
        $this->addSql('ALTER TABLE crucher DROP nbruches');
        $this->addSql('ALTER TABLE mesures_ruchers ADD date_releve DATETIME NOT NULL');
        $this->addSql('ALTER TABLE mesures_stations ADD date_releve DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cpese_ruche DROP FOREIGN KEY FK_411BADB562554C91');
        $this->addSql('ALTER TABLE cruche DROP FOREIGN KEY FK_3A3C3E574DE0AFF5');
        $this->addSql('DROP INDEX IDX_3A3C3E574DE0AFF5 ON cruche');
        $this->addSql('ALTER TABLE cruche DROP association_ruche_rucher_id');
        $this->addSql('ALTER TABLE crucher ADD nbruches SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE mesures_ruchers DROP date_releve');
        $this->addSql('ALTER TABLE mesures_stations DROP date_releve');
    }
}
