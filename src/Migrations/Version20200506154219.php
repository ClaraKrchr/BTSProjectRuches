<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506154219 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE association_ruche_peseruche (id INT AUTO_INCREMENT NOT NULL, ruche_id INT NOT NULL, peseruche_id INT NOT NULL, UNIQUE INDEX UNIQ_C897574087DDEC63 (ruche_id), UNIQUE INDEX UNIQ_C89757409769B49B (peseruche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_ruche_rucher (id INT AUTO_INCREMENT NOT NULL, ruche_id INT NOT NULL, rucher_id INT NOT NULL, UNIQUE INDEX UNIQ_AFB4648487DDEC63 (ruche_id), INDEX IDX_AFB464848BF1374E (rucher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_station_rucher (id INT AUTO_INCREMENT NOT NULL, station_id INT NOT NULL, rucher_id INT NOT NULL, UNIQUE INDEX UNIQ_EAD2A34A21BDB235 (station_id), INDEX IDX_EAD2A34A8BF1374E (rucher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE association_ruche_peseruche ADD CONSTRAINT FK_C897574087DDEC63 FOREIGN KEY (ruche_id) REFERENCES cruche (id)');
        $this->addSql('ALTER TABLE association_ruche_peseruche ADD CONSTRAINT FK_C89757409769B49B FOREIGN KEY (peseruche_id) REFERENCES cpese_ruche (id)');
        $this->addSql('ALTER TABLE association_ruche_rucher ADD CONSTRAINT FK_AFB4648487DDEC63 FOREIGN KEY (ruche_id) REFERENCES cruche (id)');
        $this->addSql('ALTER TABLE association_ruche_rucher ADD CONSTRAINT FK_AFB464848BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
        $this->addSql('ALTER TABLE association_station_rucher ADD CONSTRAINT FK_EAD2A34A21BDB235 FOREIGN KEY (station_id) REFERENCES cstation (id)');
        $this->addSql('ALTER TABLE association_station_rucher ADD CONSTRAINT FK_EAD2A34A8BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE association_ruche_peseruche');
        $this->addSql('DROP TABLE association_ruche_rucher');
        $this->addSql('DROP TABLE association_station_rucher');
    }
}
