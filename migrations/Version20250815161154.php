<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250815161154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE states DROP FOREIGN KEY FK_31C2774DE3272D31');
        $this->addSql('DROP INDEX IDX_31C2774DE3272D31 ON states');
        $this->addSql('ALTER TABLE states DROP tasks_id');
        $this->addSql('ALTER TABLE task ADD state_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB255D83CC1 FOREIGN KEY (state_id) REFERENCES states (id)');
        $this->addSql('CREATE INDEX IDX_527EDB255D83CC1 ON task (state_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE states ADD tasks_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE states ADD CONSTRAINT FK_31C2774DE3272D31 FOREIGN KEY (tasks_id) REFERENCES task (id)');
        $this->addSql('CREATE INDEX IDX_31C2774DE3272D31 ON states (tasks_id)');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB255D83CC1');
        $this->addSql('DROP INDEX IDX_527EDB255D83CC1 ON task');
        $this->addSql('ALTER TABLE task DROP state_id');
    }
}
