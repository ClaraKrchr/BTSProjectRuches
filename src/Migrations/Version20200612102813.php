<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612102813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mesures_ruches DROP FOREIGN KEY FK_FFE2624A9769B49B');
        $this->addSql('DROP INDEX IDX_FFE2624A9769B49B ON mesures_ruches');
        $this->addSql('ALTER TABLE mesures_ruches ADD idstationport INT NOT NULL, CHANGE peseruche_id idruche INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mesures_ruches ADD peseruche_id INT NOT NULL, DROP idruche, DROP idstationport');
        $this->addSql('ALTER TABLE mesures_ruches ADD CONSTRAINT FK_FFE2624A9769B49B FOREIGN KEY (peseruche_id) REFERENCES cpese_ruche (id)');
        $this->addSql('CREATE INDEX IDX_FFE2624A9769B49B ON mesures_ruches (peseruche_id)');
    }
}
