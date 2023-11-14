<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113094643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_user DROP FOREIGN KEY FK_AD8A54A9642B8210');
        $this->addSql('ALTER TABLE admin_user DROP FOREIGN KEY FK_AD8A54A9A76ED395');
        $this->addSql('DROP TABLE admin_user');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DC0F37DD6');
        $this->addSql('DROP INDEX IDX_6EEAA67DC0F37DD6 ON commande');
        $this->addSql('ALTER TABLE commande CHANGE le_client_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA76ED395 ON commande (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin_user (admin_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_AD8A54A9642B8210 (admin_id), INDEX IDX_AD8A54A9A76ED395 (user_id), PRIMARY KEY(admin_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE admin_user ADD CONSTRAINT FK_AD8A54A9642B8210 FOREIGN KEY (admin_id) REFERENCES `admin` (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_user ADD CONSTRAINT FK_AD8A54A9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('DROP INDEX IDX_6EEAA67DA76ED395 ON commande');
        $this->addSql('ALTER TABLE commande CHANGE user_id le_client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DC0F37DD6 FOREIGN KEY (le_client_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6EEAA67DC0F37DD6 ON commande (le_client_id)');
    }
}
