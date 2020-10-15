<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201014063946 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE gestion_commande');
        $this->addSql('ALTER TABLE commande ADD date_commande DATETIME NOT NULL, ADD montant_total INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gestion_commande (id INT AUTO_INCREMENT NOT NULL, id_commande_id INT DEFAULT NULL, date_commande DATETIME NOT NULL, montant_total NUMERIC(10, 2) NOT NULL, INDEX IDX_AA23B2549AF8E3A3 (id_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE gestion_commande ADD CONSTRAINT FK_AA23B2549AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande DROP date_commande, DROP montant_total');
    }
}
