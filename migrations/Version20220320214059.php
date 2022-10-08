<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220320214059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<SQL
                    CREATE TABLE `audience` 
                    (
                        id INT AUTO_INCREMENT NOT NULL, 
                        name VARCHAR(255) DEFAULT NULL, 
                        capacity INT DEFAULT NULL, 
                        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
                    SQL
                    );
        $this->addSql(<<<SQL
            CREATE TABLE category 
            (
                id INT AUTO_INCREMENT NOT NULL,
                news_id INT DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                INDEX IDX_64C19C1B5A459A0 (news_id), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE `day` 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE direction
            (
                id INT AUTO_INCREMENT NOT NULL, 
                code VARCHAR(255) NOT NULL, 
                description LONGTEXT DEFAULT NULL, 
                video_link VARCHAR(255) DEFAULT NULL, 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE education 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                lecturer_id INT DEFAULT NULL, 
                level ENUM('Higher', 'Secondary', 'Secondary_special'), 
                place LONGTEXT NOT NULL, 
                proof_document_link VARCHAR(300) NOT NULL, 
                INDEX IDX_DB0A5ED2BA2D8762 (lecturer_id), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE `group` 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                curator_id INT NOT NULL, 
                headman_id INT NOT NULL, 
                direction_id INT NOT NULL, 
                study_variant_id INT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                is_active TINYINT(1) DEFAULT 1 NOT NULL, 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                UNIQUE INDEX UNIQ_6DC044C5733D5B5D (curator_id), 
                UNIQUE INDEX UNIQ_6DC044C5637FEA1 (headman_id), 
                UNIQUE INDEX UNIQ_6DC044C5AF73D997 (direction_id), 
                UNIQUE INDEX UNIQ_6DC044C5BCF5CDCF (study_variant_id), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE lecturer 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                user_id INT NOT NULL, 
                slug VARCHAR(255) DEFAULT NULL, 
                position ENUM('Lecturer', 'Senior_lecturer', 'Docent', 'Software_engineer', 'Senior_laboratory_assistant'), 
                card_image VARCHAR(255) DEFAULT NULL, 
                professional_interests LONGTEXT DEFAULT NULL, 
                publications_count SMALLINT DEFAULT NULL, 
                projects_count SMALLINT DEFAULT NULL, 
                conferences_count SMALLINT DEFAULT NULL, 
                diploma_projects_count SMALLINT DEFAULT NULL, 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                UNIQUE INDEX UNIQ_14CF5146A76ED395 (user_id), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE news 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                title VARCHAR(255) NOT NULL, 
                description LONGTEXT NOT NULL, 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE payment_form 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                direction_id INT DEFAULT NULL, 
                name ENUM('budget', 'contract'), 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                INDEX IDX_730B6A3BAF73D997 (direction_id), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE preparation_exam 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                direction_id INT DEFAULT NULL, 
                subject_name VARCHAR(255) NOT NULL, 
                additional_info VARCHAR(255) NOT NULL, 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                INDEX IDX_8A46F005AF73D997 (direction_id), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE profile 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                direction_id INT DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                INDEX IDX_8157AA0FAF73D997 (direction_id), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE regalia 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                lecturer_id INT DEFAULT NULL, 
                name ENUM('Candidate_economic_sciences', 'Department_head', 'Candidate_technical_sciences', 'Candidate_pedagogical_sciences', 'Leading_specialist'),
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                INDEX IDX_D96D08CABA2D8762 (lecturer_id), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE specialty 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                direction_id INT DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                INDEX IDX_E066A6ECAF73D997 (direction_id), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE study_stage 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                direction_id INT DEFAULT NULL, 
                name VARCHAR(50) NOT NULL, 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                INDEX IDX_9D06C389AF73D997 (direction_id), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE study_variant 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                years SMALLINT NOT NULL, 
                months SMALLINT DEFAULT NULL, 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                time_form ENUM('full_time', 'part_time'), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE subject 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE time_table 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                associated_group_id INT NOT NULL, 
                day_id INT NOT NULL, 
                subject_id INT NOT NULL, 
                lecturer_id INT NOT NULL, 
                type_id INT NOT NULL, 
                audience_id INT NOT NULL, 
                deletion_author_id INT DEFAULT NULL, 
                pair_number SMALLINT NOT NULL, 
                pair_start TIME NOT NULL, 
                pair_end TIME NOT NULL, 
                deleted_at DATETIME DEFAULT NULL, 
                additional_info LONGTEXT DEFAULT NULL, 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                is_deleted TINYINT(1) DEFAULT 0 NOT NULL, 
                UNIQUE INDEX UNIQ_B35B6E3A8FFE1531 (associated_group_id), 
                UNIQUE INDEX UNIQ_B35B6E3A9C24126 (day_id), 
                UNIQUE INDEX UNIQ_B35B6E3A23EDC87 (subject_id), 
                UNIQUE INDEX UNIQ_B35B6E3ABA2D8762 (lecturer_id),
                UNIQUE INDEX UNIQ_B35B6E3AC54C8C93 (type_id), 
                UNIQUE INDEX UNIQ_B35B6E3A848CC616 (audience_id), 
                UNIQUE INDEX UNIQ_B35B6E3A994B5661 (deletion_author_id), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE type 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                value VARCHAR(255) NOT NULL, 
                marker_color VARCHAR(255) DEFAULT NULL, 
                created_at DATETIME DEFAULT NULL, 
                updated_at DATETIME DEFAULT NULL, 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql(<<<SQL
            CREATE TABLE user 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                associated_group_id INT DEFAULT NULL, 
                email VARCHAR(180) NOT NULL, 
                roles JSON NOT NULL, 
                password VARCHAR(255) NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                phone VARCHAR(255) DEFAULT NULL, 
                surname VARCHAR(255) DEFAULT NULL, 
                avatar_path VARCHAR(255) DEFAULT NULL, 
                UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), 
                INDEX IDX_8D93D6498FFE1531 (associated_group_id), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
            SQL
            );
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id)');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2BA2D8762 FOREIGN KEY (lecturer_id) REFERENCES lecturer (id)');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C5733D5B5D FOREIGN KEY (curator_id) REFERENCES lecturer (id)');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C5637FEA1 FOREIGN KEY (headman_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C5AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C5BCF5CDCF FOREIGN KEY (study_variant_id) REFERENCES study_variant (id)');
        $this->addSql('ALTER TABLE lecturer ADD CONSTRAINT FK_14CF5146A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE payment_form ADD CONSTRAINT FK_730B6A3BAF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('ALTER TABLE preparation_exam ADD CONSTRAINT FK_8A46F005AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FAF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('ALTER TABLE regalia ADD CONSTRAINT FK_D96D08CABA2D8762 FOREIGN KEY (lecturer_id) REFERENCES lecturer (id)');
        $this->addSql('ALTER TABLE specialty ADD CONSTRAINT FK_E066A6ECAF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('ALTER TABLE study_stage ADD CONSTRAINT FK_9D06C389AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('ALTER TABLE time_table ADD CONSTRAINT FK_B35B6E3A8FFE1531 FOREIGN KEY (associated_group_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE time_table ADD CONSTRAINT FK_B35B6E3A9C24126 FOREIGN KEY (day_id) REFERENCES `day` (id)');
        $this->addSql('ALTER TABLE time_table ADD CONSTRAINT FK_B35B6E3A23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE time_table ADD CONSTRAINT FK_B35B6E3ABA2D8762 FOREIGN KEY (lecturer_id) REFERENCES lecturer (id)');
        $this->addSql('ALTER TABLE time_table ADD CONSTRAINT FK_B35B6E3AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE time_table ADD CONSTRAINT FK_B35B6E3A848CC616 FOREIGN KEY (audience_id) REFERENCES `audience` (id)');
        $this->addSql('ALTER TABLE time_table ADD CONSTRAINT FK_B35B6E3A994B5661 FOREIGN KEY (deletion_author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498FFE1531 FOREIGN KEY (associated_group_id) REFERENCES `group` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE time_table DROP FOREIGN KEY FK_B35B6E3A848CC616');
        $this->addSql('ALTER TABLE time_table DROP FOREIGN KEY FK_B35B6E3A9C24126');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C5AF73D997');
        $this->addSql('ALTER TABLE payment_form DROP FOREIGN KEY FK_730B6A3BAF73D997');
        $this->addSql('ALTER TABLE preparation_exam DROP FOREIGN KEY FK_8A46F005AF73D997');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0FAF73D997');
        $this->addSql('ALTER TABLE specialty DROP FOREIGN KEY FK_E066A6ECAF73D997');
        $this->addSql('ALTER TABLE study_stage DROP FOREIGN KEY FK_9D06C389AF73D997');
        $this->addSql('ALTER TABLE time_table DROP FOREIGN KEY FK_B35B6E3A8FFE1531');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498FFE1531');
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED2BA2D8762');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C5733D5B5D');
        $this->addSql('ALTER TABLE regalia DROP FOREIGN KEY FK_D96D08CABA2D8762');
        $this->addSql('ALTER TABLE time_table DROP FOREIGN KEY FK_B35B6E3ABA2D8762');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1B5A459A0');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C5BCF5CDCF');
        $this->addSql('ALTER TABLE time_table DROP FOREIGN KEY FK_B35B6E3A23EDC87');
        $this->addSql('ALTER TABLE time_table DROP FOREIGN KEY FK_B35B6E3AC54C8C93');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C5637FEA1');
        $this->addSql('ALTER TABLE lecturer DROP FOREIGN KEY FK_14CF5146A76ED395');
        $this->addSql('ALTER TABLE time_table DROP FOREIGN KEY FK_B35B6E3A994B5661');
        $this->addSql('DROP TABLE `audience`');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE `day`');
        $this->addSql('DROP TABLE direction');
        $this->addSql('DROP TABLE education');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE lecturer');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE payment_form');
        $this->addSql('DROP TABLE preparation_exam');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE regalia');
        $this->addSql('DROP TABLE specialty');
        $this->addSql('DROP TABLE study_stage');
        $this->addSql('DROP TABLE study_variant');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE time_table');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
    }
}
