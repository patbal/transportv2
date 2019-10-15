<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191015165539 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE zzadresse');
        $this->addSql('ALTER TABLE adresse CHANGE nom nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE contact ADD nom_societe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638FDB8F574 FOREIGN KEY (nom_societe_id) REFERENCES adresse (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638FDB8F574 ON contact (nom_societe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE zzadresse (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, adresse2 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, codepostal VARCHAR(5) NOT NULL COLLATE utf8mb4_unicode_ci, ville VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, pays VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, adresse1 VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE adresse CHANGE nom nom VARCHAR(255) DEFAULT \'\' NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638FDB8F574');
        $this->addSql('DROP INDEX IDX_4C62E638FDB8F574 ON contact');
        $this->addSql('ALTER TABLE contact DROP nom_societe_id');
    }
}
