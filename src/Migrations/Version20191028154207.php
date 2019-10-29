<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191028154207 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E5B00BFC4');
        $this->addSql('DROP INDEX IDX_66AB212E5B00BFC4 ON transport');
        $this->addSql('ALTER TABLE transport CHANGE contact_expeditaire_id contact_expediteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E31AB1CE6 FOREIGN KEY (contact_expediteur_id) REFERENCES contact (id)');
        $this->addSql('CREATE INDEX IDX_66AB212E31AB1CE6 ON transport (contact_expediteur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E31AB1CE6');
        $this->addSql('DROP INDEX IDX_66AB212E31AB1CE6 ON transport');
        $this->addSql('ALTER TABLE transport CHANGE contact_expediteur_id contact_expeditaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E5B00BFC4 FOREIGN KEY (contact_expeditaire_id) REFERENCES contact (id)');
        $this->addSql('CREATE INDEX IDX_66AB212E5B00BFC4 ON transport (contact_expeditaire_id)');
    }
}
