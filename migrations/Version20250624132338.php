<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250624132338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE fuel_type ADD fuel_id INT NOT NULL, DROP type
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fuel_type ADD CONSTRAINT FK_9CA10F3897C79677 FOREIGN KEY (fuel_id) REFERENCES fuel (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9CA10F3897C79677 ON fuel_type (fuel_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE fuel_type DROP FOREIGN KEY FK_9CA10F3897C79677
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_9CA10F3897C79677 ON fuel_type
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fuel_type ADD type VARCHAR(255) NOT NULL, DROP fuel_id
        SQL);
    }
}
