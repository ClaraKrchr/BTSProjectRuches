<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200327132419 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE blog_post (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE capiculteur (id_api INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, mail VARCHAR(255) NOT NULL, mdp VARCHAR(30) NOT NULL, tel VARCHAR(10) NOT NULL, code_postal VARCHAR(6) NOT NULL, ville VARCHAR(255) NOT NULL, post_addr VARCHAR(255) NOT NULL, PRIMARY KEY(id_api)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE capiculture (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stop (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE capiculteur');
        $this->addSql('DROP TABLE capiculture');
        $this->addSql('DROP TABLE stop');
    }
}
