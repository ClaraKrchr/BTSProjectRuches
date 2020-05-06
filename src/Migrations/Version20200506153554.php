<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506153554 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE association_peseruche_station (id INT AUTO_INCREMENT NOT NULL, peseruche_id INT NOT NULL, station_id INT NOT NULL, UNIQUE INDEX UNIQ_FB327F5D9769B49B (peseruche_id), INDEX IDX_FB327F5D21BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE association_peseruche_station ADD CONSTRAINT FK_FB327F5D9769B49B FOREIGN KEY (peseruche_id) REFERENCES cpese_ruche (id)');
        $this->addSql('ALTER TABLE association_peseruche_station ADD CONSTRAINT FK_FB327F5D21BDB235 FOREIGN KEY (station_id) REFERENCES cstation (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE association_peseruche_station');
    }
}
