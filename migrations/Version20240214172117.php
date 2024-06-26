<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214172117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__lecon AS SELECT id, nom, description FROM lecon');
        $this->addSql('DROP TABLE lecon');
        $this->addSql('CREATE TABLE lecon (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, professeur_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, CONSTRAINT FK_94E6242EBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO lecon (id, nom, description) SELECT id, nom, description FROM __temp__lecon');
        $this->addSql('DROP TABLE __temp__lecon');
        $this->addSql('CREATE INDEX IDX_94E6242EBAB22EE9 ON lecon (professeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__lecon AS SELECT id, nom, description FROM lecon');
        $this->addSql('DROP TABLE lecon');
        $this->addSql('CREATE TABLE lecon (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO lecon (id, nom, description) SELECT id, nom, description FROM __temp__lecon');
        $this->addSql('DROP TABLE __temp__lecon');
    }
}
