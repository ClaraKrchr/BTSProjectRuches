<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200516134754 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE action (id INT AUTO_INCREMENT NOT NULL, nomaction VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_action_carnet (action_id INT NOT NULL, carnet_id INT NOT NULL, INDEX IDX_6E97EC09D32F035 (action_id), INDEX IDX_6E97EC0FA207516 (carnet_id), PRIMARY KEY(action_id, carnet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_apiculteur_carnet (apiculteur_id SMALLINT NOT NULL, carnet_id INT NOT NULL, INDEX IDX_4D31E05DFD789156 (apiculteur_id), INDEX IDX_4D31E05DFA207516 (carnet_id), PRIMARY KEY(apiculteur_id, carnet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_ruche_carnet (ruche_id INT NOT NULL, carnet_id INT NOT NULL, INDEX IDX_F7156D8587DDEC63 (ruche_id), INDEX IDX_F7156D85FA207516 (carnet_id), PRIMARY KEY(ruche_id, carnet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carnet (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE association_action_carnet ADD CONSTRAINT FK_6E97EC09D32F035 FOREIGN KEY (action_id) REFERENCES action (id)');
        $this->addSql('ALTER TABLE association_action_carnet ADD CONSTRAINT FK_6E97EC0FA207516 FOREIGN KEY (carnet_id) REFERENCES carnet (id)');
        $this->addSql('ALTER TABLE association_apiculteur_carnet ADD CONSTRAINT FK_4D31E05DFD789156 FOREIGN KEY (apiculteur_id) REFERENCES capiculteur (id)');
        $this->addSql('ALTER TABLE association_apiculteur_carnet ADD CONSTRAINT FK_4D31E05DFA207516 FOREIGN KEY (carnet_id) REFERENCES carnet (id)');
        $this->addSql('ALTER TABLE association_ruche_carnet ADD CONSTRAINT FK_F7156D8587DDEC63 FOREIGN KEY (ruche_id) REFERENCES cruche (id)');
        $this->addSql('ALTER TABLE association_ruche_carnet ADD CONSTRAINT FK_F7156D85FA207516 FOREIGN KEY (carnet_id) REFERENCES carnet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE association_action_carnet DROP FOREIGN KEY FK_6E97EC09D32F035');
        $this->addSql('ALTER TABLE association_action_carnet DROP FOREIGN KEY FK_6E97EC0FA207516');
        $this->addSql('ALTER TABLE association_apiculteur_carnet DROP FOREIGN KEY FK_4D31E05DFA207516');
        $this->addSql('ALTER TABLE association_ruche_carnet DROP FOREIGN KEY FK_F7156D85FA207516');
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE association_action_carnet');
        $this->addSql('DROP TABLE association_apiculteur_carnet');
        $this->addSql('DROP TABLE association_ruche_carnet');
        $this->addSql('DROP TABLE carnet');
    }
}
