<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506152715 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cruche DROP FOREIGN KEY FK_3A3C3E574DE0AFF5');
        $this->addSql('ALTER TABLE cstation DROP FOREIGN KEY FK_39135FFEF6BB911E');
        $this->addSql('DROP TABLE association_peseruche_station');
        $this->addSql('DROP TABLE association_ruche_peseruche');
        $this->addSql('DROP TABLE association_ruche_rucher');
        $this->addSql('DROP TABLE association_station_rucher');
        $this->addSql('DROP INDEX IDX_411BADB562554C91 ON cpese_ruche');
        $this->addSql('ALTER TABLE cpese_ruche DROP association_peseruche_station_id');
        $this->addSql('DROP INDEX IDX_3A3C3E574DE0AFF5 ON cruche');
        $this->addSql('ALTER TABLE cruche DROP association_ruche_rucher_id');
        $this->addSql('DROP INDEX IDX_39135FFEF6BB911E ON cstation');
        $this->addSql('ALTER TABLE cstation DROP association_station_rucher_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE association_peseruche_station (id INT AUTO_INCREMENT NOT NULL, station_id INT NOT NULL, UNIQUE INDEX UNIQ_FB327F5D21BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE association_ruche_peseruche (id INT AUTO_INCREMENT NOT NULL, ruche_id INT NOT NULL, peseruche_id INT NOT NULL, UNIQUE INDEX UNIQ_C897574087DDEC63 (ruche_id), UNIQUE INDEX UNIQ_C89757409769B49B (peseruche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE association_ruche_rucher (id INT AUTO_INCREMENT NOT NULL, rucher_id INT NOT NULL, UNIQUE INDEX UNIQ_AFB464848BF1374E (rucher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE association_station_rucher (id INT AUTO_INCREMENT NOT NULL, rucher_id INT NOT NULL, UNIQUE INDEX UNIQ_EAD2A34A8BF1374E (rucher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE association_peseruche_station ADD CONSTRAINT FK_FB327F5D21BDB235 FOREIGN KEY (station_id) REFERENCES cstation (id)');
        $this->addSql('ALTER TABLE association_ruche_peseruche ADD CONSTRAINT FK_C897574087DDEC63 FOREIGN KEY (ruche_id) REFERENCES cruche (id)');
        $this->addSql('ALTER TABLE association_ruche_peseruche ADD CONSTRAINT FK_C89757409769B49B FOREIGN KEY (peseruche_id) REFERENCES cpese_ruche (id)');
        $this->addSql('ALTER TABLE association_ruche_rucher ADD CONSTRAINT FK_AFB464848BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
        $this->addSql('ALTER TABLE association_station_rucher ADD CONSTRAINT FK_EAD2A34A8BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
        $this->addSql('ALTER TABLE cpese_ruche ADD association_peseruche_station_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_411BADB562554C91 ON cpese_ruche (association_peseruche_station_id)');
        $this->addSql('ALTER TABLE cruche ADD association_ruche_rucher_id INT NOT NULL');
        $this->addSql('ALTER TABLE cruche ADD CONSTRAINT FK_3A3C3E574DE0AFF5 FOREIGN KEY (association_ruche_rucher_id) REFERENCES association_ruche_rucher (id)');
        $this->addSql('CREATE INDEX IDX_3A3C3E574DE0AFF5 ON cruche (association_ruche_rucher_id)');
        $this->addSql('ALTER TABLE cstation ADD association_station_rucher_id INT NOT NULL');
        $this->addSql('ALTER TABLE cstation ADD CONSTRAINT FK_39135FFEF6BB911E FOREIGN KEY (association_station_rucher_id) REFERENCES association_station_rucher (id)');
        $this->addSql('CREATE INDEX IDX_39135FFEF6BB911E ON cstation (association_station_rucher_id)');
    }
}
