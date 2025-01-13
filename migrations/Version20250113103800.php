<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250113103800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_activity ADD user_activity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_activity ADD CONSTRAINT FK_4CF9ED5A28DBA903 FOREIGN KEY (user_activity_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4CF9ED5A28DBA903 ON user_activity (user_activity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_activity DROP FOREIGN KEY FK_4CF9ED5A28DBA903');
        $this->addSql('DROP INDEX IDX_4CF9ED5A28DBA903 ON user_activity');
        $this->addSql('ALTER TABLE user_activity DROP user_activity_id');
    }
}
