<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429214745 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cpese_ruche ADD humiditeinter SMALLINT DEFAULT NULL, ADD humiditeexter SMALLINT DEFAULT NULL, ADD tempinter SMALLINT DEFAULT NULL, ADD tempexter SMALLINT DEFAULT NULL, ADD niveau SMALLINT DEFAULT NULL, DROP humidite_inter, DROP humidite_exter, DROP temp_inter, DROP temp_exter, DROP niv_eau, CHANGE nom_pese_ruche nompeseruche VARCHAR(30) NOT NULL, CHANGE date_install dateinstall DATE DEFAULT NULL, CHANGE date_releve datereleve DATETIME DEFAULT NULL, CHANGE type_ruche typeruche VARCHAR(15) DEFAULT NULL');
        $this->addSql('ALTER TABLE crucher CHANGE nb_ruches nbruches SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cpese_ruche ADD humidite_inter SMALLINT DEFAULT NULL, ADD humidite_exter SMALLINT DEFAULT NULL, ADD temp_inter SMALLINT DEFAULT NULL, ADD temp_exter SMALLINT DEFAULT NULL, ADD niv_eau SMALLINT DEFAULT NULL, DROP humiditeinter, DROP humiditeexter, DROP tempinter, DROP tempexter, DROP niveau, CHANGE nompeseruche nom_pese_ruche VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dateinstall date_install DATE DEFAULT NULL, CHANGE datereleve date_releve DATETIME DEFAULT NULL, CHANGE typeruche type_ruche VARCHAR(15) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE crucher CHANGE nbruches nb_ruches SMALLINT DEFAULT NULL');
    }
}
