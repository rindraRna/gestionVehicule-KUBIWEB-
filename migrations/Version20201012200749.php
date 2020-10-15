<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201012200749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrateur (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, client_commande_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, INDEX IDX_C744045583A10B6F (client_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, commande_details_commande_id INT DEFAULT NULL, commande_gestion_commande_id INT DEFAULT NULL, INDEX IDX_6EEAA67DA4D2915F (commande_details_commande_id), INDEX IDX_6EEAA67D34226B4A (commande_gestion_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details_commande (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gestion_commande (id INT AUTO_INCREMENT NOT NULL, date_commande DATETIME NOT NULL, montant_total NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, id_fournisseur_id INT NOT NULL, marque_produit_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5A6F91CE5A6AC879 (id_fournisseur_id), INDEX IDX_5A6F91CEF6F5CB59 (marque_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, produit_details_commande_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, quantite_en_stock INT NOT NULL, prix NUMERIC(10, 2) NOT NULL, type VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, INDEX IDX_29A5EC2727C200B9 (produit_details_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045583A10B6F FOREIGN KEY (client_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA4D2915F FOREIGN KEY (commande_details_commande_id) REFERENCES details_commande (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D34226B4A FOREIGN KEY (commande_gestion_commande_id) REFERENCES gestion_commande (id)');
        $this->addSql('ALTER TABLE marque ADD CONSTRAINT FK_5A6F91CE5A6AC879 FOREIGN KEY (id_fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE marque ADD CONSTRAINT FK_5A6F91CEF6F5CB59 FOREIGN KEY (marque_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2727C200B9 FOREIGN KEY (produit_details_commande_id) REFERENCES details_commande (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045583A10B6F');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA4D2915F');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2727C200B9');
        $this->addSql('ALTER TABLE marque DROP FOREIGN KEY FK_5A6F91CE5A6AC879');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D34226B4A');
        $this->addSql('ALTER TABLE marque DROP FOREIGN KEY FK_5A6F91CEF6F5CB59');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE details_commande');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE gestion_commande');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE produit');
    }
}
