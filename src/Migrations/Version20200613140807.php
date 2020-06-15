<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200613140807 extends AbstractMigration
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
        $this->addSql('DROP TABLE AssocierRuchePort');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE AssocierRuchePort (numport INT NOT NULL, ruche_id INT NOT NULL, station_id INT NOT NULL, INDEX IDX_88ECA4A587DDEC63 (ruche_id), UNIQUE INDEX UNIQ_88ECA4A521BDB2351E7D4598 (station_id, numport), INDEX IDX_88ECA4A521BDB235 (station_id), PRIMARY KEY(ruche_id, station_id, numport)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE AssocierRuchePort ADD CONSTRAINT FK_88ECA4A521BDB235 FOREIGN KEY (station_id) REFERENCES cstation (id)');
        $this->addSql('ALTER TABLE AssocierRuchePort ADD CONSTRAINT FK_88ECA4A587DDEC63 FOREIGN KEY (ruche_id) REFERENCES cruche (id)');
        $this->addSql('DROP TABLE associer_ruche_port');
    }
}
