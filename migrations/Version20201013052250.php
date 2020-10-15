<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013052250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045583A10B6F');
        $this->addSql('DROP INDEX IDX_C744045583A10B6F ON client');
        $this->addSql('ALTER TABLE client DROP client_commande_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD client_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045583A10B6F FOREIGN KEY (client_commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_C744045583A10B6F ON client (client_commande_id)');
    }
}
