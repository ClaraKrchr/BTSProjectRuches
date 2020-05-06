<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506120946 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cruche (id INT AUTO_INCREMENT NOT NULL, nomruche VARCHAR(30) NOT NULL, dateinstall DATE DEFAULT NULL, typeruche VARCHAR(50) DEFAULT NULL, visibilite TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mesures_ruches (id INT AUTO_INCREMENT NOT NULL, ruche_id_id INT NOT NULL, poids SMALLINT DEFAULT NULL, INDEX IDX_FFE2624A2679A247 (ruche_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mesures_ruches ADD CONSTRAINT FK_FFE2624A2679A247 FOREIGN KEY (ruche_id_id) REFERENCES cruche (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mesures_ruches DROP FOREIGN KEY FK_FFE2624A2679A247');
        $this->addSql('DROP TABLE cruche');
        $this->addSql('DROP TABLE mesures_ruches');
    }
}
