<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010140215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin_client (admin_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_9A8C35AC642B8210 (admin_id), INDEX IDX_9A8C35AC19EB6921 (client_id), PRIMARY KEY(admin_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE casier (id INT AUTO_INCREMENT NOT NULL, le_relais_id INT DEFAULT NULL, INDEX IDX_3FDF2858259B9D7 (le_relais_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colis (id INT AUTO_INCREMENT NOT NULL, la_commande_id INT DEFAULT NULL, le_casier_id INT NOT NULL, numero_colis VARCHAR(255) NOT NULL, poids INT NOT NULL, INDEX IDX_470BDFF93743EDD (la_commande_id), INDEX IDX_470BDFF9BD210531 (le_casier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, le_client_id INT DEFAULT NULL, nbr_colis INT NOT NULL, INDEX IDX_6EEAA67DC0F37DD6 (le_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat_colis (id INT AUTO_INCREMENT NOT NULL, etat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE le_client (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, le_colis_id INT DEFAULT NULL, INDEX IDX_BF5476CA8368A699 (le_colis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relais (id INT AUTO_INCREMENT NOT NULL, la_ville_id INT DEFAULT NULL, nombre_casier VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_E32CEC90609A8BA5 (la_ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relais_admin (relais_id INT NOT NULL, admin_id INT NOT NULL, INDEX IDX_B334A3085B41AD20 (relais_id), INDEX IDX_B334A308642B8210 (admin_id), PRIMARY KEY(relais_id, admin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, code_postal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE volume (id INT AUTO_INCREMENT NOT NULL, taille VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin_client ADD CONSTRAINT FK_9A8C35AC642B8210 FOREIGN KEY (admin_id) REFERENCES `admin` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_client ADD CONSTRAINT FK_9A8C35AC19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE casier ADD CONSTRAINT FK_3FDF2858259B9D7 FOREIGN KEY (le_relais_id) REFERENCES relais (id)');
        $this->addSql('ALTER TABLE colis ADD CONSTRAINT FK_470BDFF93743EDD FOREIGN KEY (la_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE colis ADD CONSTRAINT FK_470BDFF9BD210531 FOREIGN KEY (le_casier_id) REFERENCES casier (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DC0F37DD6 FOREIGN KEY (le_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA8368A699 FOREIGN KEY (le_colis_id) REFERENCES colis (id)');
        $this->addSql('ALTER TABLE relais ADD CONSTRAINT FK_E32CEC90609A8BA5 FOREIGN KEY (la_ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE relais_admin ADD CONSTRAINT FK_B334A3085B41AD20 FOREIGN KEY (relais_id) REFERENCES relais (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relais_admin ADD CONSTRAINT FK_B334A308642B8210 FOREIGN KEY (admin_id) REFERENCES `admin` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_client DROP FOREIGN KEY FK_9A8C35AC642B8210');
        $this->addSql('ALTER TABLE admin_client DROP FOREIGN KEY FK_9A8C35AC19EB6921');
        $this->addSql('ALTER TABLE casier DROP FOREIGN KEY FK_3FDF2858259B9D7');
        $this->addSql('ALTER TABLE colis DROP FOREIGN KEY FK_470BDFF93743EDD');
        $this->addSql('ALTER TABLE colis DROP FOREIGN KEY FK_470BDFF9BD210531');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DC0F37DD6');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA8368A699');
        $this->addSql('ALTER TABLE relais DROP FOREIGN KEY FK_E32CEC90609A8BA5');
        $this->addSql('ALTER TABLE relais_admin DROP FOREIGN KEY FK_B334A3085B41AD20');
        $this->addSql('ALTER TABLE relais_admin DROP FOREIGN KEY FK_B334A308642B8210');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE admin_client');
        $this->addSql('DROP TABLE casier');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE colis');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE etat_colis');
        $this->addSql('DROP TABLE le_client');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE relais');
        $this->addSql('DROP TABLE relais_admin');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE volume');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
