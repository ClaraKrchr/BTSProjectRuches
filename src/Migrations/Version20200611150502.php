<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200611150502 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE associer_ruche_rucher (id INT AUTO_INCREMENT NOT NULL, ruche_id INT NOT NULL, rucher_id INT NOT NULL, UNIQUE INDEX UNIQ_EE40561887DDEC63 (ruche_id), INDEX IDX_EE4056188BF1374E (rucher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE associer_ruche_rucher ADD CONSTRAINT FK_EE40561887DDEC63 FOREIGN KEY (ruche_id) REFERENCES cruche (id)');
        $this->addSql('ALTER TABLE associer_ruche_rucher ADD CONSTRAINT FK_EE4056188BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
        $this->addSql('DROP TABLE association_ruche_rucher');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE association_ruche_rucher (ruche_id INT NOT NULL, rucher_id INT NOT NULL, INDEX IDX_AFB4648487DDEC63 (ruche_id), INDEX IDX_AFB464848BF1374E (rucher_id), PRIMARY KEY(ruche_id, rucher_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE association_ruche_rucher ADD CONSTRAINT FK_AFB4648487DDEC63 FOREIGN KEY (ruche_id) REFERENCES cruche (id)');
        $this->addSql('ALTER TABLE association_ruche_rucher ADD CONSTRAINT FK_AFB464848BF1374E FOREIGN KEY (rucher_id) REFERENCES crucher (id)');
        $this->addSql('DROP TABLE associer_ruche_rucher');
    }
}
