<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200507143924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE association_ruche_apiculteur DROP INDEX UNIQ_45ACF70487DDEC63, ADD INDEX IDX_45ACF70487DDEC63 (ruche_id)');
        $this->addSql('ALTER TABLE association_ruche_apiculteur MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE association_ruche_apiculteur DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE association_ruche_apiculteur DROP id');
        $this->addSql('ALTER TABLE association_ruche_apiculteur ADD PRIMARY KEY (ruche_id, apiculteur_id)');
        $this->addSql('ALTER TABLE association_ruche_peseruche DROP INDEX UNIQ_C89757409769B49B, ADD INDEX IDX_C89757409769B49B (peseruche_id)');
        $this->addSql('ALTER TABLE association_ruche_peseruche DROP INDEX UNIQ_C897574087DDEC63, ADD INDEX IDX_C897574087DDEC63 (ruche_id)');
        $this->addSql('ALTER TABLE association_ruche_peseruche MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE association_ruche_peseruche DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE association_ruche_peseruche DROP id');
        $this->addSql('ALTER TABLE association_ruche_peseruche ADD PRIMARY KEY (ruche_id, peseruche_id)');
        $this->addSql('ALTER TABLE association_ruche_rucher DROP INDEX UNIQ_AFB4648487DDEC63, ADD INDEX IDX_AFB4648487DDEC63 (ruche_id)');
        $this->addSql('ALTER TABLE association_ruche_rucher MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE association_ruche_rucher DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE association_ruche_rucher DROP id');
        $this->addSql('ALTER TABLE association_ruche_rucher ADD PRIMARY KEY (ruche_id, rucher_id)');
        $this->addSql('ALTER TABLE association_station_rucher DROP INDEX UNIQ_EAD2A34A21BDB235, ADD INDEX IDX_EAD2A34A21BDB235 (station_id)');
        $this->addSql('ALTER TABLE association_station_rucher MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE association_station_rucher DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE association_station_rucher DROP id');
        $this->addSql('ALTER TABLE association_station_rucher ADD PRIMARY KEY (station_id, rucher_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE association_ruche_apiculteur DROP INDEX IDX_45ACF70487DDEC63, ADD UNIQUE INDEX UNIQ_45ACF70487DDEC63 (ruche_id)');
        $this->addSql('ALTER TABLE association_ruche_apiculteur ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE association_ruche_peseruche DROP INDEX IDX_C897574087DDEC63, ADD UNIQUE INDEX UNIQ_C897574087DDEC63 (ruche_id)');
        $this->addSql('ALTER TABLE association_ruche_peseruche DROP INDEX IDX_C89757409769B49B, ADD UNIQUE INDEX UNIQ_C89757409769B49B (peseruche_id)');
        $this->addSql('ALTER TABLE association_ruche_peseruche ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE association_ruche_rucher DROP INDEX IDX_AFB4648487DDEC63, ADD UNIQUE INDEX UNIQ_AFB4648487DDEC63 (ruche_id)');
        $this->addSql('ALTER TABLE association_ruche_rucher ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE association_station_rucher DROP INDEX IDX_EAD2A34A21BDB235, ADD UNIQUE INDEX UNIQ_EAD2A34A21BDB235 (station_id)');
        $this->addSql('ALTER TABLE association_station_rucher ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
