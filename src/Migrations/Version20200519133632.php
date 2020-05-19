<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200519133632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet ADD etat_ruche VARCHAR(7) DEFAULT NULL, ADD nb_cadres_couvain INT DEFAULT NULL, ADD presence_males VARCHAR(3) DEFAULT NULL, ADD presence_larves VARCHAR(3) DEFAULT NULL, ADD presence_oeufs VARCHAR(3) DEFAULT NULL, ADD couvain_opercule VARCHAR(3) DEFAULT NULL, ADD eatt_essaim VARCHAR(25) DEFAULT NULL, ADD date_reine DATE DEFAULT NULL, ADD cellules_royales VARCHAR(3) DEFAULT NULL, ADD race_reine VARCHAR(255) DEFAULT NULL, ADD age_reine INT DEFAULT NULL, ADD nb_cadres_miel INT DEFAULT NULL, ADD nb_cadres_pollen INT DEFAULT NULL, ADD date_traitement DATE DEFAULT NULL, ADD nature_traitement VARCHAR(255) DEFAULT NULL, ADD date_nourrissement DATE DEFAULT NULL, ADD qtt_nourrissement INT DEFAULT NULL, ADD nature_nourrissement VARCHAR(255) DEFAULT NULL, ADD origine_essaim VARCHAR(255) DEFAULT NULL, ADD nb_hausse_recoltees INT DEFAULT NULL, ADD date_recolte DATE DEFAULT NULL, ADD nature_miel VARCHAR(20) DEFAULT NULL, ADD presence_varroa VARCHAR(12) DEFAULT NULL, ADD etat_abeilles VARCHAR(255) DEFAULT NULL, ADD date_transhumance DATE DEFAULT NULL, ADD lieu_transhumance VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carnet DROP etat_ruche, DROP nb_cadres_couvain, DROP presence_males, DROP presence_larves, DROP presence_oeufs, DROP couvain_opercule, DROP eatt_essaim, DROP date_reine, DROP cellules_royales, DROP race_reine, DROP age_reine, DROP nb_cadres_miel, DROP nb_cadres_pollen, DROP date_traitement, DROP nature_traitement, DROP date_nourrissement, DROP qtt_nourrissement, DROP nature_nourrissement, DROP origine_essaim, DROP nb_hausse_recoltees, DROP date_recolte, DROP nature_miel, DROP presence_varroa, DROP etat_abeilles, DROP date_transhumance, DROP lieu_transhumance');
    }
}
