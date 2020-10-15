<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013050331 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marque DROP FOREIGN KEY FK_5A6F91CEF6F5CB59');
        $this->addSql('DROP INDEX IDX_5A6F91CEF6F5CB59 ON marque');
        $this->addSql('ALTER TABLE marque DROP marque_produit_id');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2727C200B9');
        $this->addSql('DROP INDEX IDX_29A5EC2727C200B9 ON produit');
        $this->addSql('ALTER TABLE produit CHANGE produit_details_commande_id id_marque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27C8120595 FOREIGN KEY (id_marque_id) REFERENCES marque (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27C8120595 ON produit (id_marque_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marque ADD marque_produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE marque ADD CONSTRAINT FK_5A6F91CEF6F5CB59 FOREIGN KEY (marque_produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_5A6F91CEF6F5CB59 ON marque (marque_produit_id)');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27C8120595');
        $this->addSql('DROP INDEX IDX_29A5EC27C8120595 ON produit');
        $this->addSql('ALTER TABLE produit CHANGE id_marque_id produit_details_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2727C200B9 FOREIGN KEY (produit_details_commande_id) REFERENCES details_commande (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2727C200B9 ON produit (produit_details_commande_id)');
    }
}
