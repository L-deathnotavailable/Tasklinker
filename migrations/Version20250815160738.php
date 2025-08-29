<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250815160738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE states ADD tasks_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE states ADD CONSTRAINT FK_31C2774DE3272D31 FOREIGN KEY (tasks_id) REFERENCES task (id)');
        $this->addSql('CREATE INDEX IDX_31C2774DE3272D31 ON states (tasks_id)');
        $this->addSql('ALTER TABLE task DROP status_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE states DROP FOREIGN KEY FK_31C2774DE3272D31');
        $this->addSql('DROP INDEX IDX_31C2774DE3272D31 ON states');
        $this->addSql('ALTER TABLE states DROP tasks_id');
        $this->addSql('ALTER TABLE task ADD status_id INT NOT NULL');
    }
}
