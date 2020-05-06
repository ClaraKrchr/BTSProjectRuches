<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506122805 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mesures_peseruches DROP FOREIGN KEY FK_45EF7EDD23C020F6');
        $this->addSql('DROP INDEX IDX_45EF7EDD23C020F6 ON mesures_peseruches');
        $this->addSql('ALTER TABLE mesures_peseruches CHANGE peseruche_id_id peseruche_id INT NOT NULL');
        $this->addSql('ALTER TABLE mesures_peseruches ADD CONSTRAINT FK_45EF7EDD9769B49B FOREIGN KEY (peseruche_id) REFERENCES cpese_ruche (id)');
        $this->addSql('CREATE INDEX IDX_45EF7EDD9769B49B ON mesures_peseruches (peseruche_id)');
        $this->addSql('ALTER TABLE mesures_ruches DROP FOREIGN KEY FK_FFE2624A2679A247');
        $this->addSql('DROP INDEX IDX_FFE2624A2679A247 ON mesures_ruches');
        $this->addSql('ALTER TABLE mesures_ruches CHANGE ruche_id_id ruche_id INT NOT NULL');
        $this->addSql('ALTER TABLE mesures_ruches ADD CONSTRAINT FK_FFE2624A87DDEC63 FOREIGN KEY (ruche_id) REFERENCES cruche (id)');
        $this->addSql('CREATE INDEX IDX_FFE2624A87DDEC63 ON mesures_ruches (ruche_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mesures_peseruches DROP FOREIGN KEY FK_45EF7EDD9769B49B');
        $this->addSql('DROP INDEX IDX_45EF7EDD9769B49B ON mesures_peseruches');
        $this->addSql('ALTER TABLE mesures_peseruches CHANGE peseruche_id peseruche_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE mesures_peseruches ADD CONSTRAINT FK_45EF7EDD23C020F6 FOREIGN KEY (peseruche_id_id) REFERENCES cpese_ruche (id)');
        $this->addSql('CREATE INDEX IDX_45EF7EDD23C020F6 ON mesures_peseruches (peseruche_id_id)');
        $this->addSql('ALTER TABLE mesures_ruches DROP FOREIGN KEY FK_FFE2624A87DDEC63');
        $this->addSql('DROP INDEX IDX_FFE2624A87DDEC63 ON mesures_ruches');
        $this->addSql('ALTER TABLE mesures_ruches CHANGE ruche_id ruche_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE mesures_ruches ADD CONSTRAINT FK_FFE2624A2679A247 FOREIGN KEY (ruche_id_id) REFERENCES cruche (id)');
        $this->addSql('CREATE INDEX IDX_FFE2624A2679A247 ON mesures_ruches (ruche_id_id)');
    }
}
