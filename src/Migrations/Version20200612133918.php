<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612133918 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE associer_ruche_apiculteur (ruche_id INT NOT NULL, apiculteur_id SMALLINT NOT NULL, INDEX IDX_E4DECD5987DDEC63 (ruche_id), INDEX IDX_E4DECD59FD789156 (apiculteur_id), PRIMARY KEY(ruche_id, apiculteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE associer_ruche_apiculteur ADD CONSTRAINT FK_E4DECD5987DDEC63 FOREIGN KEY (ruche_id) REFERENCES cruche (id)');
        $this->addSql('ALTER TABLE associer_ruche_apiculteur ADD CONSTRAINT FK_E4DECD59FD789156 FOREIGN KEY (apiculteur_id) REFERENCES capiculteur (id)');
        $this->addSql('DROP TABLE association_ruche_apiculteur');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE association_ruche_apiculteur (ruche_id INT NOT NULL, apiculteur_id SMALLINT NOT NULL, INDEX IDX_45ACF704FD789156 (apiculteur_id), INDEX IDX_45ACF70487DDEC63 (ruche_id), PRIMARY KEY(ruche_id, apiculteur_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE association_ruche_apiculteur ADD CONSTRAINT FK_45ACF70487DDEC63 FOREIGN KEY (ruche_id) REFERENCES cruche (id)');
        $this->addSql('ALTER TABLE association_ruche_apiculteur ADD CONSTRAINT FK_45ACF704FD789156 FOREIGN KEY (apiculteur_id) REFERENCES capiculteur (id)');
        $this->addSql('DROP TABLE associer_ruche_apiculteur');
    }
}
