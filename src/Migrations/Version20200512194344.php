<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512194344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE association_rucher_region (id INT AUTO_INCREMENT NOT NULL, rucher_id INT NOT NULL, region_id INT NOT NULL, UNIQUE INDEX UNIQ_623B3F628BF1374E (rucher_id), INDEX IDX_623B3F6298260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE association_rucher_region ADD CONSTRAINT FK_623B3F628BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
        $this->addSql('ALTER TABLE association_rucher_region ADD CONSTRAINT FK_623B3F6298260155 FOREIGN KEY (region_id) REFERENCES regions (id)');
        $this->addSql('ALTER TABLE crucher DROP region_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE association_rucher_region');
        $this->addSql('ALTER TABLE crucher ADD region_id INT NOT NULL');
    }
}
