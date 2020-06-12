<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612152824 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mesures_stations DROP FOREIGN KEY FK_76E19478BF1374E');
        $this->addSql('DROP INDEX IDX_76E19478BF1374E ON mesures_stations');
        $this->addSql('ALTER TABLE mesures_stations DROP rucher_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mesures_stations ADD rucher_id INT NOT NULL');
        $this->addSql('ALTER TABLE mesures_stations ADD CONSTRAINT FK_76E19478BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
        $this->addSql('CREATE INDEX IDX_76E19478BF1374E ON mesures_stations (rucher_id)');
    }
}
