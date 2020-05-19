<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200519144114 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet ADD racereine VARCHAR(255) DEFAULT NULL, ADD agereine INT DEFAULT NULL, ADD nbcadresmiel INT DEFAULT NULL, ADD nbcadrespollen INT DEFAULT NULL, ADD datetraitement DATE DEFAULT NULL, ADD naturetraitement VARCHAR(255) DEFAULT NULL, ADD datenourrissement DATE DEFAULT NULL, ADD qttnourrissement INT DEFAULT NULL, ADD naturenourrissement VARCHAR(255) DEFAULT NULL, ADD origineessaim VARCHAR(255) DEFAULT NULL, ADD nbhausserecoltees INT DEFAULT NULL, ADD daterecolte DATE DEFAULT NULL, ADD etatabeilles VARCHAR(255) DEFAULT NULL, ADD datetranshumance DATE DEFAULT NULL, DROP race_reine, DROP age_reine, DROP nb_cadres_miel, DROP nb_cadres_pollen, DROP date_traitement, DROP nature_traitement, DROP date_nourrissement, DROP qtt_nourrissement, DROP nature_nourrissement, DROP origine_essaim, DROP nb_hausse_recoltees, DROP date_recolte, DROP etat_abeilles, DROP date_transhumance, CHANGE nature_miel naturemiel VARCHAR(20) DEFAULT NULL, CHANGE presence_varroa presencevarroa VARCHAR(12) DEFAULT NULL, CHANGE lieu_transhumance lieutranshumance VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet ADD race_reine VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD age_reine INT DEFAULT NULL, ADD nb_cadres_miel INT DEFAULT NULL, ADD nb_cadres_pollen INT DEFAULT NULL, ADD date_traitement DATE DEFAULT NULL, ADD nature_traitement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD date_nourrissement DATE DEFAULT NULL, ADD qtt_nourrissement INT DEFAULT NULL, ADD nature_nourrissement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD origine_essaim VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD nb_hausse_recoltees INT DEFAULT NULL, ADD date_recolte DATE DEFAULT NULL, ADD etat_abeilles VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD date_transhumance DATE DEFAULT NULL, DROP racereine, DROP agereine, DROP nbcadresmiel, DROP nbcadrespollen, DROP datetraitement, DROP naturetraitement, DROP datenourrissement, DROP qttnourrissement, DROP naturenourrissement, DROP origineessaim, DROP nbhausserecoltees, DROP daterecolte, DROP etatabeilles, DROP datetranshumance, CHANGE naturemiel nature_miel VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE presencevarroa presence_varroa VARCHAR(12) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lieutranshumance lieu_transhumance VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
