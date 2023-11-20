<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120175152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE localisation (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, adresse VARCHAR(140) NOT NULL, code_postal VARCHAR(6) NOT NULL, ville VARCHAR(50) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, pays VARCHAR(50) NOT NULL, INDEX IDX_BFD3CE8FA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE localisation ADD CONSTRAINT FK_BFD3CE8FA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE localisation DROP FOREIGN KEY FK_BFD3CE8FA4AEAFEA');
        $this->addSql('DROP TABLE localisation');
    }
}
