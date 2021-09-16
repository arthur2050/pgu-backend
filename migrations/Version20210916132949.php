<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210916132949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE audience (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, capacity INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE day (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pair (id INT AUTO_INCREMENT NOT NULL, start VARCHAR(255) NOT NULL, end VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB23EDC87');
        $this->addSql('DROP INDEX UNIQ_5A3811FB23EDC87 ON schedule');
        $this->addSql('ALTER TABLE schedule ADD day_id INT DEFAULT NULL, ADD audience_id INT DEFAULT NULL, ADD even_subject_id INT DEFAULT NULL, ADD odd_subject_id INT DEFAULT NULL, ADD is_even TINYINT(1) DEFAULT NULL, DROP pair_number, DROP day_number, DROP even, DROP odd, DROP day_name, CHANGE subject_id pair_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB7EB8B2A3 FOREIGN KEY (pair_id) REFERENCES pair (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB9C24126 FOREIGN KEY (day_id) REFERENCES day (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB848CC616 FOREIGN KEY (audience_id) REFERENCES audience (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB6C8A4B34 FOREIGN KEY (even_subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FBE41E38B4 FOREIGN KEY (odd_subject_id) REFERENCES subject (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A3811FB7EB8B2A3 ON schedule (pair_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A3811FB9C24126 ON schedule (day_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A3811FB848CC616 ON schedule (audience_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A3811FB6C8A4B34 ON schedule (even_subject_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A3811FBE41E38B4 ON schedule (odd_subject_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB848CC616');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB9C24126');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB7EB8B2A3');
        $this->addSql('DROP TABLE audience');
        $this->addSql('DROP TABLE day');
        $this->addSql('DROP TABLE pair');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB6C8A4B34');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FBE41E38B4');
        $this->addSql('DROP INDEX UNIQ_5A3811FB7EB8B2A3 ON schedule');
        $this->addSql('DROP INDEX UNIQ_5A3811FB9C24126 ON schedule');
        $this->addSql('DROP INDEX UNIQ_5A3811FB848CC616 ON schedule');
        $this->addSql('DROP INDEX UNIQ_5A3811FB6C8A4B34 ON schedule');
        $this->addSql('DROP INDEX UNIQ_5A3811FBE41E38B4 ON schedule');
        $this->addSql('ALTER TABLE schedule ADD subject_id INT DEFAULT NULL, ADD pair_number INT NOT NULL, ADD day_number INT NOT NULL, ADD odd TINYINT(1) DEFAULT NULL, ADD day_name VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, DROP pair_id, DROP day_id, DROP audience_id, DROP even_subject_id, DROP odd_subject_id, CHANGE is_even even TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A3811FB23EDC87 ON schedule (subject_id)');
    }
}
