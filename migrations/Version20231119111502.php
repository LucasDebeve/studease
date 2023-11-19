<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231119111502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE insertion_professionnelle (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, date_deb DATE NOT NULL, date_fin DATE DEFAULT NULL, desc_ins_pro LONGTEXT NOT NULL, teletravail TINYINT(1) DEFAULT NULL, titre VARCHAR(50) NOT NULL, gratification DOUBLE PRECISION DEFAULT NULL, salaire DOUBLE PRECISION DEFAULT NULL, type_pro SMALLINT NOT NULL, duree INT NOT NULL, INDEX IDX_3CD8CA4C979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE insertion_professionnelle ADD CONSTRAINT FK_3CD8CA4C979B1AD6 FOREIGN KEY (company_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE insertion_professionnelle DROP FOREIGN KEY FK_3CD8CA4C979B1AD6');
        $this->addSql('DROP TABLE insertion_professionnelle');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }
}
