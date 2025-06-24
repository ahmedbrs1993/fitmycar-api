<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250624123814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE fuel_type (id INT AUTO_INCREMENT NOT NULL, generation_id INT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_9CA10F38553A6EC4 (generation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE generation (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D3266C3B7975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D79572D944F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, specs JSON NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE product_compatibility (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, fuel_type_id INT NOT NULL, INDEX IDX_A92134964584665A (product_id), INDEX IDX_A92134966A70FE35 (fuel_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fuel_type ADD CONSTRAINT FK_9CA10F38553A6EC4 FOREIGN KEY (generation_id) REFERENCES generation (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE generation ADD CONSTRAINT FK_D3266C3B7975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_compatibility ADD CONSTRAINT FK_A92134964584665A FOREIGN KEY (product_id) REFERENCES product (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_compatibility ADD CONSTRAINT FK_A92134966A70FE35 FOREIGN KEY (fuel_type_id) REFERENCES fuel_type (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE fuel_type DROP FOREIGN KEY FK_9CA10F38553A6EC4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE generation DROP FOREIGN KEY FK_D3266C3B7975B7E7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_compatibility DROP FOREIGN KEY FK_A92134964584665A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_compatibility DROP FOREIGN KEY FK_A92134966A70FE35
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE brand
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE fuel_type
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE generation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE model
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE product
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE product_compatibility
        SQL);
    }
}
