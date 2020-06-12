<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612154222 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE associer_station_rucher (id INT AUTO_INCREMENT NOT NULL, station_id INT NOT NULL, rucher_id INT NOT NULL, UNIQUE INDEX UNIQ_FFF1762821BDB235 (station_id), INDEX IDX_FFF176288BF1374E (rucher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE associer_station_rucher ADD CONSTRAINT FK_FFF1762821BDB235 FOREIGN KEY (station_id) REFERENCES cstation (id)');
        $this->addSql('ALTER TABLE associer_station_rucher ADD CONSTRAINT FK_FFF176288BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
        $this->addSql('DROP TABLE association_station_rucher');
        $this->addSql('ALTER TABLE cstation DROP idstation');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE association_station_rucher (station_id INT NOT NULL, rucher_id INT NOT NULL, INDEX IDX_EAD2A34A21BDB235 (station_id), INDEX IDX_EAD2A34A8BF1374E (rucher_id), PRIMARY KEY(station_id, rucher_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE association_station_rucher ADD CONSTRAINT FK_EAD2A34A21BDB235 FOREIGN KEY (station_id) REFERENCES cstation (id)');
        $this->addSql('ALTER TABLE association_station_rucher ADD CONSTRAINT FK_EAD2A34A8BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
        $this->addSql('DROP TABLE associer_station_rucher');
        $this->addSql('ALTER TABLE cstation ADD idstation BIGINT DEFAULT NULL');
    }
}
