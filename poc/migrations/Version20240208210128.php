<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240208210128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livre_categorie (livre_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_E61B069E37D925CB (livre_id), INDEX IDX_E61B069EBCF5E72D (categorie_id), PRIMARY KEY(livre_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livre_categorie ADD CONSTRAINT FK_E61B069E37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_categorie ADD CONSTRAINT FK_E61B069EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_livre DROP FOREIGN KEY FK_591BA24937D925CB');
        $this->addSql('ALTER TABLE categorie_livre DROP FOREIGN KEY FK_591BA249BCF5E72D');
        $this->addSql('DROP TABLE categorie_livre');
        $this->addSql('ALTER TABLE adherent CHANGE num_tel num_tel INT NOT NULL');
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
        $this->addSql('CREATE TABLE categorie_livre (categorie_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_591BA24937D925CB (livre_id), INDEX IDX_591BA249BCF5E72D (categorie_id), PRIMARY KEY(categorie_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categorie_livre ADD CONSTRAINT FK_591BA24937D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_livre ADD CONSTRAINT FK_591BA249BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_categorie DROP FOREIGN KEY FK_E61B069E37D925CB');
        $this->addSql('ALTER TABLE livre_categorie DROP FOREIGN KEY FK_E61B069EBCF5E72D');
        $this->addSql('DROP TABLE livre_categorie');
        $this->addSql('ALTER TABLE adherent CHANGE num_tel num_tel VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE emprunt DROP retard, DROP rendu');
        $this->addSql('ALTER TABLE livre ADD reservations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99D9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC634F99D9A7F869 ON livre (reservations_id)');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23937D925CB');
        $this->addSql('DROP INDEX IDX_4DA23937D925CB ON reservations');
        $this->addSql('ALTER TABLE reservations DROP livre_id');
    }
}
