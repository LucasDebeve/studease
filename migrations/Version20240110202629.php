<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110202629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE insertion_professionnelle DROP FOREIGN KEY FK_3CD8CA4C979B1AD6');
        $this->addSql('DROP INDEX IDX_3CD8CA4C979B1AD6 ON insertion_professionnelle');
        $this->addSql('ALTER TABLE insertion_professionnelle CHANGE company_id localisation_id INT NOT NULL');
        $this->addSql('ALTER TABLE insertion_professionnelle ADD CONSTRAINT FK_3CD8CA4CC68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
        $this->addSql('CREATE INDEX IDX_3CD8CA4CC68BE09C ON insertion_professionnelle (localisation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE insertion_professionnelle DROP FOREIGN KEY FK_3CD8CA4CC68BE09C');
        $this->addSql('DROP INDEX IDX_3CD8CA4CC68BE09C ON insertion_professionnelle');
        $this->addSql('ALTER TABLE insertion_professionnelle CHANGE localisation_id company_id INT NOT NULL');
        $this->addSql('ALTER TABLE insertion_professionnelle ADD CONSTRAINT FK_3CD8CA4C979B1AD6 FOREIGN KEY (company_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3CD8CA4C979B1AD6 ON insertion_professionnelle (company_id)');
    }
}
