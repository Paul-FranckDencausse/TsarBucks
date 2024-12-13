<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241213150807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activities (id INT AUTO_INCREMENT NOT NULL, association_id INT NOT NULL, media_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE allergies (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE associations (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, raison_sociale VARCHAR(255) NOT NULL, media_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forbidden_foods (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredients (id INT AUTO_INCREMENT NOT NULL, supplier_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, media_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loyalty (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, points INT NOT NULL, rewards VARCHAR(255) NOT NULL, money_spent INT NOT NULL, starred VARCHAR(255) NOT NULL, media_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, file_path VARCHAR(255) DEFAULT NULL, file_type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, media_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, recipe_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes (id INT AUTO_INCREMENT NOT NULL, ingredient_id INT NOT NULL, media_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, saloon_id DATE NOT NULL, date DATE NOT NULL, people INT NOT NULL, status VARCHAR(255) NOT NULL, activity_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reviews (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, saloon_id INT NOT NULL, stars INT NOT NULL, comment VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, is_admin TINYINT(1) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE root (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saloon_menu (id INT AUTO_INCREMENT NOT NULL, saloon_id INT NOT NULL, menu_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saloons (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, number INT NOT NULL, email VARCHAR(255) NOT NULL, opening_hours VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suppliers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, raison_sociale VARCHAR(255) NOT NULL, media_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE translations (id INT AUTO_INCREMENT NOT NULL, table_name VARCHAR(255) DEFAULT NULL, column_name VARCHAR(255) DEFAULT NULL, row_id INT DEFAULT NULL, translated_text VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact CHANGE message message LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prénom prénom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE activities');
        $this->addSql('DROP TABLE allergies');
        $this->addSql('DROP TABLE associations');
        $this->addSql('DROP TABLE forbidden_foods');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('DROP TABLE loyalty');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE recipes');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE root');
        $this->addSql('DROP TABLE saloon_menu');
        $this->addSql('DROP TABLE saloons');
        $this->addSql('DROP TABLE suppliers');
        $this->addSql('DROP TABLE translations');
        $this->addSql('ALTER TABLE user CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prénom prénom VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact CHANGE message message VARCHAR(500) NOT NULL');
    }
}
