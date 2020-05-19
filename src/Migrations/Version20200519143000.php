<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200519143000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet ADD presencemales VARCHAR(3) DEFAULT NULL, ADD presencelarves VARCHAR(3) DEFAULT NULL, ADD presenceoeufs VARCHAR(3) DEFAULT NULL, ADD couvainopercule VARCHAR(3) DEFAULT NULL, ADD cellulesroyales VARCHAR(3) DEFAULT NULL, DROP presence_males, DROP presence_larves, DROP presence_oeufs, DROP couvain_opercule, DROP cellules_royales, CHANGE etat_ruche etatruche VARCHAR(7) DEFAULT NULL, CHANGE nb_cadres_couvain nbcadrescouvain INT DEFAULT NULL, CHANGE etat_essaim etatessaim VARCHAR(25) DEFAULT NULL, CHANGE date_reine datereine DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet ADD presence_males VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD presence_larves VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD presence_oeufs VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD couvain_opercule VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD cellules_royales VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP presencemales, DROP presencelarves, DROP presenceoeufs, DROP couvainopercule, DROP cellulesroyales, CHANGE etatruche etat_ruche VARCHAR(7) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nbcadrescouvain nb_cadres_couvain INT DEFAULT NULL, CHANGE etatessaim etat_essaim VARCHAR(25) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE datereine date_reine DATE DEFAULT NULL');
    }
}
