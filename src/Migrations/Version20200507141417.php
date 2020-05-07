<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200507141417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE association_peseruche_station DROP INDEX UNIQ_FB327F5D9769B49B, ADD INDEX IDX_FB327F5D9769B49B (peseruche_id)');
        $this->addSql('ALTER TABLE association_peseruche_station MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE association_peseruche_station DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE association_peseruche_station DROP id');
        $this->addSql('ALTER TABLE association_peseruche_station ADD PRIMARY KEY (peseruche_id, station_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE association_peseruche_station DROP INDEX IDX_FB327F5D9769B49B, ADD UNIQUE INDEX UNIQ_FB327F5D9769B49B (peseruche_id)');
        $this->addSql('ALTER TABLE association_peseruche_station ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
