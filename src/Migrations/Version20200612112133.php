<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612112133 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE associer_ruche_port (numport INT NOT NULL, ruche_id INT NOT NULL, station_id INT NOT NULL, INDEX IDX_AA34D79A87DDEC63 (ruche_id), INDEX IDX_AA34D79A21BDB235 (station_id), PRIMARY KEY(ruche_id, station_id, numport)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE associer_ruche_port ADD CONSTRAINT FK_AA34D79A87DDEC63 FOREIGN KEY (ruche_id) REFERENCES cruche (id)');
        $this->addSql('ALTER TABLE associer_ruche_port ADD CONSTRAINT FK_AA34D79A21BDB235 FOREIGN KEY (station_id) REFERENCES cstation (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE associer_ruche_port');
    }
}
