<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200613141301 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE associer_ruche_rucher DROP INDEX IDX_EE40561887DDEC63, ADD UNIQUE INDEX UNIQ_EE40561887DDEC63 (ruche_id)');
        $this->addSql('ALTER TABLE associer_station_rucher DROP INDEX IDX_FFF1762821BDB235, ADD UNIQUE INDEX UNIQ_FFF1762821BDB235 (station_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE associer_ruche_rucher DROP INDEX UNIQ_EE40561887DDEC63, ADD INDEX IDX_EE40561887DDEC63 (ruche_id)');
        $this->addSql('ALTER TABLE associer_station_rucher DROP INDEX UNIQ_FFF1762821BDB235, ADD INDEX IDX_FFF1762821BDB235 (station_id)');
    }
}
