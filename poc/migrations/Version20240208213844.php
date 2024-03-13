<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240208213844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt ADD retard VARCHAR(10) DEFAULT NULL, ADD rendu VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99D9A7F869');
        $this->addSql('DROP INDEX UNIQ_AC634F99D9A7F869 ON livre');
        $this->addSql('ALTER TABLE livre DROP reservations_id');
        $this->addSql('ALTER TABLE reservations ADD livre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23937D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('CREATE INDEX IDX_4DA23937D925CB ON reservations (livre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt DROP retard, DROP rendu');
        $this->addSql('ALTER TABLE livre ADD reservations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99D9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC634F99D9A7F869 ON livre (reservations_id)');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23937D925CB');
        $this->addSql('DROP INDEX IDX_4DA23937D925CB ON reservations');
        $this->addSql('ALTER TABLE reservations DROP livre_id');
    }
}
