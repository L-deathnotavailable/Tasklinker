<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250801152532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_employe (project_id INT NOT NULL, employe_id INT NOT NULL, INDEX IDX_6E1ADFDC166D1F9C (project_id), INDEX IDX_6E1ADFDC1B65292 (employe_id), PRIMARY KEY(project_id, employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_employe ADD CONSTRAINT FK_6E1ADFDC166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_employe ADD CONSTRAINT FK_6E1ADFDC1B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_employe DROP FOREIGN KEY FK_6E1ADFDC166D1F9C');
        $this->addSql('ALTER TABLE project_employe DROP FOREIGN KEY FK_6E1ADFDC1B65292');
        $this->addSql('DROP TABLE project_employe');
    }
}
