<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221101114126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, wiki_page VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, name VARCHAR(255) NOT NULL, year_of_release VARCHAR(255) NOT NULL, order_of_release INT NOT NULL, summary LONGTEXT NOT NULL, cover VARCHAR(255) DEFAULT NULL, sub_serie VARCHAR(255) NOT NULL, INDEX IDX_CBE5A331F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_faction (book_id INT NOT NULL, faction_id INT NOT NULL, INDEX IDX_1024A30616A2B381 (book_id), INDEX IDX_1024A3064448F8DA (faction_id), PRIMARY KEY(book_id, faction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_primarch (book_id INT NOT NULL, primarch_id INT NOT NULL, INDEX IDX_3C75899A16A2B381 (book_id), INDEX IDX_3C75899AE1C11E7 (primarch_id), PRIMARY KEY(book_id, primarch_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faction (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE primarch (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, chapter VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE book_faction ADD CONSTRAINT FK_1024A30616A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_faction ADD CONSTRAINT FK_1024A3064448F8DA FOREIGN KEY (faction_id) REFERENCES faction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_primarch ADD CONSTRAINT FK_3C75899A16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_primarch ADD CONSTRAINT FK_3C75899AE1C11E7 FOREIGN KEY (primarch_id) REFERENCES primarch (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B');
        $this->addSql('ALTER TABLE book_faction DROP FOREIGN KEY FK_1024A30616A2B381');
        $this->addSql('ALTER TABLE book_primarch DROP FOREIGN KEY FK_3C75899A16A2B381');
        $this->addSql('ALTER TABLE book_faction DROP FOREIGN KEY FK_1024A3064448F8DA');
        $this->addSql('ALTER TABLE book_primarch DROP FOREIGN KEY FK_3C75899AE1C11E7');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE book_faction');
        $this->addSql('DROP TABLE book_primarch');
        $this->addSql('DROP TABLE faction');
        $this->addSql('DROP TABLE primarch');
    }
}
