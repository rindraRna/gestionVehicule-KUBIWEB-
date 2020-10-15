<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013054021 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gestion_commande ADD id_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gestion_commande ADD CONSTRAINT FK_AA23B2549AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_AA23B2549AF8E3A3 ON gestion_commande (id_commande_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gestion_commande DROP FOREIGN KEY FK_AA23B2549AF8E3A3');
        $this->addSql('DROP INDEX IDX_AA23B2549AF8E3A3 ON gestion_commande');
        $this->addSql('ALTER TABLE gestion_commande DROP id_commande_id');
    }
}
