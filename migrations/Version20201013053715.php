<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013053715 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE details_commande ADD id_produit_id INT DEFAULT NULL, ADD id_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE details_commande ADD CONSTRAINT FK_4BCD5F6AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE details_commande ADD CONSTRAINT FK_4BCD5F69AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_4BCD5F6AABEFE2C ON details_commande (id_produit_id)');
        $this->addSql('CREATE INDEX IDX_4BCD5F69AF8E3A3 ON details_commande (id_commande_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE details_commande DROP FOREIGN KEY FK_4BCD5F6AABEFE2C');
        $this->addSql('ALTER TABLE details_commande DROP FOREIGN KEY FK_4BCD5F69AF8E3A3');
        $this->addSql('DROP INDEX IDX_4BCD5F6AABEFE2C ON details_commande');
        $this->addSql('DROP INDEX IDX_4BCD5F69AF8E3A3 ON details_commande');
        $this->addSql('ALTER TABLE details_commande DROP id_produit_id, DROP id_commande_id');
    }
}
