<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241124204629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) DEFAULT NULL, date_sortie DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournoi (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournoi_pokemon (tournoi_id INT NOT NULL, pokemon_id INT NOT NULL, INDEX IDX_4F282CD0F607770A (tournoi_id), INDEX IDX_4F282CD02FE71C3E (pokemon_id), PRIMARY KEY(tournoi_id, pokemon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tournoi_pokemon ADD CONSTRAINT FK_4F282CD0F607770A FOREIGN KEY (tournoi_id) REFERENCES tournoi (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tournoi_pokemon ADD CONSTRAINT FK_4F282CD02FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon ADD serie_id INT DEFAULT NULL, ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F3D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_62DC90F3D94388BD ON pokemon (serie_id)');
        $this->addSql('CREATE INDEX IDX_62DC90F382EA2E54 ON pokemon (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F382EA2E54');
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F3D94388BD');
        $this->addSql('ALTER TABLE tournoi_pokemon DROP FOREIGN KEY FK_4F282CD0F607770A');
        $this->addSql('ALTER TABLE tournoi_pokemon DROP FOREIGN KEY FK_4F282CD02FE71C3E');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE tournoi');
        $this->addSql('DROP TABLE tournoi_pokemon');
        $this->addSql('DROP INDEX IDX_62DC90F3D94388BD ON pokemon');
        $this->addSql('DROP INDEX IDX_62DC90F382EA2E54 ON pokemon');
        $this->addSql('ALTER TABLE pokemon DROP serie_id, DROP commande_id');
    }
}
