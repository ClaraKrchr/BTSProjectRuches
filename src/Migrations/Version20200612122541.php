<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612122541 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE association_peseruche_station DROP FOREIGN KEY FK_FB327F5D9769B49B');
        $this->addSql('ALTER TABLE association_ruche_peseruche DROP FOREIGN KEY FK_C89757409769B49B');
        $this->addSql('DROP TABLE association_peseruche_station');
        $this->addSql('DROP TABLE association_ruche_peseruche');
        $this->addSql('DROP TABLE cpese_ruche');
        $this->addSql('ALTER TABLE cruche ADD nbassosport SMALLINT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE association_peseruche_station (peseruche_id INT NOT NULL, station_id INT NOT NULL, INDEX IDX_FB327F5D9769B49B (peseruche_id), INDEX IDX_FB327F5D21BDB235 (station_id), PRIMARY KEY(peseruche_id, station_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE association_ruche_peseruche (ruche_id INT NOT NULL, peseruche_id INT NOT NULL, INDEX IDX_C897574087DDEC63 (ruche_id), INDEX IDX_C89757409769B49B (peseruche_id), PRIMARY KEY(ruche_id, peseruche_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cpese_ruche (id INT AUTO_INCREMENT NOT NULL, nompeseruche VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, dateinstall DATE DEFAULT NULL, nb_assos_ruche TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE association_peseruche_station ADD CONSTRAINT FK_FB327F5D21BDB235 FOREIGN KEY (station_id) REFERENCES cstation (id)');
        $this->addSql('ALTER TABLE association_peseruche_station ADD CONSTRAINT FK_FB327F5D9769B49B FOREIGN KEY (peseruche_id) REFERENCES cpese_ruche (id)');
        $this->addSql('ALTER TABLE association_ruche_peseruche ADD CONSTRAINT FK_C897574087DDEC63 FOREIGN KEY (ruche_id) REFERENCES cruche (id)');
        $this->addSql('ALTER TABLE association_ruche_peseruche ADD CONSTRAINT FK_C89757409769B49B FOREIGN KEY (peseruche_id) REFERENCES cpese_ruche (id)');
        $this->addSql('ALTER TABLE cruche DROP nbassosport');
    }
}
