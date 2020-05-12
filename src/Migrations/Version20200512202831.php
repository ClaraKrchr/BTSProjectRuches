<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512202831 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE association_rucher_region DROP INDEX UNIQ_623B3F628BF1374E, ADD INDEX IDX_623B3F628BF1374E (rucher_id)');
        $this->addSql('ALTER TABLE association_rucher_region MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE association_rucher_region DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE association_rucher_region DROP id');
        $this->addSql('ALTER TABLE association_rucher_region ADD PRIMARY KEY (rucher_id, region_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE association_rucher_region DROP INDEX IDX_623B3F628BF1374E, ADD UNIQUE INDEX UNIQ_623B3F628BF1374E (rucher_id)');
        $this->addSql('ALTER TABLE association_rucher_region ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
