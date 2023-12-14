<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214100411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mail (id INT AUTO_INCREMENT NOT NULL, envoyeur_id INT DEFAULT NULL, sujet VARCHAR(255) NOT NULL, contenue VARCHAR(255) NOT NULL, INDEX IDX_5126AC484795A786 (envoyeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC484795A786 FOREIGN KEY (envoyeur_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mail DROP FOREIGN KEY FK_5126AC484795A786');
        $this->addSql('DROP TABLE mail');
    }
}
