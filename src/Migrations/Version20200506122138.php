<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506122138 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mesures_peseruches (id INT AUTO_INCREMENT NOT NULL, peseruche_id_id INT NOT NULL, poids SMALLINT NOT NULL, INDEX IDX_45EF7EDD23C020F6 (peseruche_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mesures_peseruches ADD CONSTRAINT FK_45EF7EDD23C020F6 FOREIGN KEY (peseruche_id_id) REFERENCES cpese_ruche (id)');
        $this->addSql('ALTER TABLE cpese_ruche DROP poids, DROP luminosite, DROP datereleve, DROP typeruche, DROP humiditeinter, DROP humiditeexter, DROP tempinter, DROP tempexter, DROP niveau');
        $this->addSql('ALTER TABLE mesures_ruches ADD date_releve DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE mesures_peseruches');
        $this->addSql('ALTER TABLE cpese_ruche ADD poids SMALLINT UNSIGNED DEFAULT NULL, ADD luminosite SMALLINT DEFAULT NULL, ADD datereleve DATETIME DEFAULT NULL, ADD typeruche VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD humiditeinter SMALLINT DEFAULT NULL, ADD humiditeexter SMALLINT DEFAULT NULL, ADD tempinter SMALLINT DEFAULT NULL, ADD tempexter SMALLINT DEFAULT NULL, ADD niveau SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE mesures_ruches DROP date_releve');
    }
}
