<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240211153556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entrainements_exercices (entrainements_id INT NOT NULL, exercices_id INT NOT NULL, INDEX IDX_35C27C832477266C (entrainements_id), INDEX IDX_35C27C83192C7251 (exercices_id), PRIMARY KEY(entrainements_id, exercices_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entrainements_exercices ADD CONSTRAINT FK_35C27C832477266C FOREIGN KEY (entrainements_id) REFERENCES entrainements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entrainements_exercices ADD CONSTRAINT FK_35C27C83192C7251 FOREIGN KEY (exercices_id) REFERENCES exercices (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrainements_exercices DROP FOREIGN KEY FK_35C27C832477266C');
        $this->addSql('ALTER TABLE entrainements_exercices DROP FOREIGN KEY FK_35C27C83192C7251');
        $this->addSql('DROP TABLE entrainements_exercices');
    }
}
