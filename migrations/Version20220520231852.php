<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220520231852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<SQL
                CREATE TABLE user_interface_settings 
                (
                    id INT AUTO_INCREMENT NOT NULL, 
                    color_filters SMALLINT NOT NULL, 
                    color_background SMALLINT NOT NULL, 
                    dark_mode TINYINT(1) NOT NULL, 
                    sidebar_mini TINYINT(1) NOT NULL, 
                    sidebar_image TINYINT(1) NOT NULL, 
                    selected_image SMALLINT DEFAULT NULL, 
                    PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
                SQL
                );
        $this->addSql('ALTER TABLE user ADD interface_settings_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649826F9229 FOREIGN KEY (interface_settings_id) REFERENCES user_interface_settings (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649826F9229 ON user (interface_settings_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649826F9229');
        $this->addSql('DROP TABLE user_interface_settings');
        $this->addSql('DROP INDEX UNIQ_8D93D649826F9229 ON user');
        $this->addSql('ALTER TABLE user DROP interface_settings_id');
    }
}
