<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200509152103 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cpese_ruche DROP FOREIGN KEY FK_411BADB576C50E4A');
        $this->addSql('ALTER TABLE cpese_ruche DROP FOREIGN KEY FK_411BADB58BF1374E');
        $this->addSql('DROP INDEX IDX_411BADB58BF1374E ON cpese_ruche');
        $this->addSql('DROP INDEX IDX_411BADB576C50E4A ON cpese_ruche');
        $this->addSql('ALTER TABLE cpese_ruche DROP proprietaire_id, DROP rucher_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cpese_ruche ADD proprietaire_id SMALLINT NOT NULL, ADD rucher_id INT NOT NULL');
        $this->addSql('ALTER TABLE cpese_ruche ADD CONSTRAINT FK_411BADB576C50E4A FOREIGN KEY (proprietaire_id) REFERENCES capiculteur (id)');
        $this->addSql('ALTER TABLE cpese_ruche ADD CONSTRAINT FK_411BADB58BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
        $this->addSql('CREATE INDEX IDX_411BADB58BF1374E ON cpese_ruche (rucher_id)');
        $this->addSql('CREATE INDEX IDX_411BADB576C50E4A ON cpese_ruche (proprietaire_id)');
    }
}
