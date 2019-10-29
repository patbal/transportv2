<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191028113604 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, type_vehicule_id INT DEFAULT NULL, expediteur_id INT DEFAULT NULL, destinataire_id INT DEFAULT NULL, contact_expeditaire_id INT DEFAULT NULL, contact_destinataire_id INT DEFAULT NULL, date_demande DATETIME NOT NULL, date_pickup DATETIME DEFAULT NULL, date_delivery DATETIME DEFAULT NULL, date_envoi_mail DATETIME DEFAULT NULL, type VARCHAR(20) NOT NULL, nombre_palettes NUMERIC(3, 1) DEFAULT NULL, nombre_metres_plancher NUMERIC(3, 1) DEFAULT NULL, facture TINYINT(1) DEFAULT NULL, numero_facture VARCHAR(20) DEFAULT NULL, numero_demande VARCHAR(12) DEFAULT NULL, numero_locasyst VARCHAR(12) DEFAULT NULL, INDEX IDX_66AB212E153E280 (type_vehicule_id), INDEX IDX_66AB212E10335F61 (expediteur_id), INDEX IDX_66AB212EA4F84F6E (destinataire_id), INDEX IDX_66AB212E5B00BFC4 (contact_expeditaire_id), INDEX IDX_66AB212E3FEF7050 (contact_destinataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E153E280 FOREIGN KEY (type_vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E10335F61 FOREIGN KEY (expediteur_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EA4F84F6E FOREIGN KEY (destinataire_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E5B00BFC4 FOREIGN KEY (contact_expeditaire_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E3FEF7050 FOREIGN KEY (contact_destinataire_id) REFERENCES contact (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE transport');
    }
}
