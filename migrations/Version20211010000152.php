<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211010000152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blogpost (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, contents LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_1284FB7DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, paint_id INT DEFAULT NULL, blogpost_id INT DEFAULT NULL, author VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, contents LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_5F9E962A9017B5FF (paint_id), INDEX IDX_5F9E962A27F5416E (blogpost_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paint_category (paint_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_6ECF4F139017B5FF (paint_id), INDEX IDX_6ECF4F1312469DE2 (category_id), PRIMARY KEY(paint_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blogpost ADD CONSTRAINT FK_1284FB7DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A9017B5FF FOREIGN KEY (paint_id) REFERENCES paint (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A27F5416E FOREIGN KEY (blogpost_id) REFERENCES blogpost (id)');
        $this->addSql('ALTER TABLE paint_category ADD CONSTRAINT FK_6ECF4F139017B5FF FOREIGN KEY (paint_id) REFERENCES paint (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paint_category ADD CONSTRAINT FK_6ECF4F1312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paint ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE paint ADD CONSTRAINT FK_577A8417A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_577A8417A76ED395 ON paint (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A27F5416E');
        $this->addSql('DROP TABLE blogpost');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE paint_category');
        $this->addSql('ALTER TABLE paint DROP FOREIGN KEY FK_577A8417A76ED395');
        $this->addSql('DROP INDEX IDX_577A8417A76ED395 ON paint');
        $this->addSql('ALTER TABLE paint DROP user_id');
    }
}
