<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120160229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF77EF1B1E');
        $this->addSql('DROP INDEX IDX_404021BF77EF1B1E ON formation');
        $this->addSql('ALTER TABLE formation DROP ecole_id');
        $this->addSql('ALTER TABLE user ADD ecole_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64977EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64977EF1B1E ON user (ecole_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation ADD ecole_id INT NOT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF77EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
        $this->addSql('CREATE INDEX IDX_404021BF77EF1B1E ON formation (ecole_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64977EF1B1E');
        $this->addSql('DROP INDEX IDX_8D93D64977EF1B1E ON user');
        $this->addSql('ALTER TABLE user DROP ecole_id');
    }
}
