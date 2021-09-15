<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210915172218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number INT NOT NULL, full_name VARCHAR(255) NOT NULL, year_created INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id BIGINT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule (id INT AUTO_INCREMENT NOT NULL, group_id INT DEFAULT NULL, even_teacher_id INT DEFAULT NULL, odd_teacher_id INT DEFAULT NULL, subject_id INT DEFAULT NULL, pair_number INT NOT NULL, day_number INT NOT NULL, even TINYINT(1) DEFAULT NULL, odd TINYINT(1) DEFAULT NULL, day_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5A3811FBFE54D947 (group_id), UNIQUE INDEX UNIQ_5A3811FB2F34E9AE (even_teacher_id), UNIQUE INDEX UNIQ_5A3811FBA7A09A2E (odd_teacher_id), UNIQUE INDEX UNIQ_5A3811FB23EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, user_id BIGINT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, patronymic VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, subjects JSON DEFAULT NULL, avatar_path VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_B0F6A6D5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id BIGINT AUTO_INCREMENT NOT NULL, role_id BIGINT NOT NULL, `group` INT DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, avatar_path VARCHAR(2048) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649D60322AC (role_id), UNIQUE INDEX UNIQ_8D93D6496DC044C5 (`group`), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FBFE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB2F34E9AE FOREIGN KEY (even_teacher_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FBA7A09A2E FOREIGN KEY (odd_teacher_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496DC044C5 FOREIGN KEY (`group`) REFERENCES `group` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FBFE54D947');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496DC044C5');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB23EDC87');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB2F34E9AE');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FBA7A09A2E');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D5A76ED395');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE user');
    }
}
