<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218203618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE colis ADD le_relais_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE colis ADD CONSTRAINT FK_470BDFF98259B9D7 FOREIGN KEY (le_relais_id) REFERENCES relais (id)');
        $this->addSql('CREATE INDEX IDX_470BDFF98259B9D7 ON colis (le_relais_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE colis DROP FOREIGN KEY FK_470BDFF98259B9D7');
        $this->addSql('DROP INDEX IDX_470BDFF98259B9D7 ON colis');
        $this->addSql('ALTER TABLE colis DROP le_relais_id');
    }
}
