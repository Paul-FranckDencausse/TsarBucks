<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241214211254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD genre VARCHAR(20) DEFAULT NULL, ADD date_naissance DATE DEFAULT NULL, ADD telephone VARCHAR(15) DEFAULT NULL, ADD code_postal VARCHAR(10) DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', CHANGE media_id adresse VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD media_id VARCHAR(255) DEFAULT NULL, DROP genre, DROP date_naissance, DROP telephone, DROP adresse, DROP code_postal, DROP ville, DROP roles');
    }
}
