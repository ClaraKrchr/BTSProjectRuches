<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200616162814 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_3A3C3E576C49AF68 ON cruche (nomruche)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_993C07F46C6E55B5 ON crucher (nom)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A26779F32FA2817F ON regions (nomregion)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_3A3C3E576C49AF68 ON cruche');
        $this->addSql('DROP INDEX UNIQ_993C07F46C6E55B5 ON crucher');
        $this->addSql('DROP INDEX UNIQ_A26779F32FA2817F ON regions');
    }
}
