<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013053411 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D34226B4A');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA4D2915F');
        $this->addSql('DROP INDEX IDX_6EEAA67D34226B4A ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DA4D2915F ON commande');
        $this->addSql('ALTER TABLE commande ADD id_client_id INT DEFAULT NULL, DROP commande_details_commande_id, DROP commande_gestion_commande_id');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D99DED506 ON commande (id_client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D99DED506');
        $this->addSql('DROP INDEX IDX_6EEAA67D99DED506 ON commande');
        $this->addSql('ALTER TABLE commande ADD commande_gestion_commande_id INT DEFAULT NULL, CHANGE id_client_id commande_details_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D34226B4A FOREIGN KEY (commande_gestion_commande_id) REFERENCES gestion_commande (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA4D2915F FOREIGN KEY (commande_details_commande_id) REFERENCES details_commande (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D34226B4A ON commande (commande_gestion_commande_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA4D2915F ON commande (commande_details_commande_id)');
    }
}
