<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612153350 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mesures_ruches DROP FOREIGN KEY FK_FFE2624A87DDEC63');
        $this->addSql('DROP INDEX IDX_FFE2624A87DDEC63 ON mesures_ruches');
        $this->addSql('ALTER TABLE mesures_ruches DROP ruche_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mesures_ruches ADD ruche_id INT NOT NULL');
        $this->addSql('ALTER TABLE mesures_ruches ADD CONSTRAINT FK_FFE2624A87DDEC63 FOREIGN KEY (ruche_id) REFERENCES cruche (id)');
        $this->addSql('CREATE INDEX IDX_FFE2624A87DDEC63 ON mesures_ruches (ruche_id)');
    }
}
