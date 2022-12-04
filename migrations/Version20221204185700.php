<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221204185700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            INSERT INTO faculty (id, name)
            VALUES
            (1, "Informatica si Matematica"),
            (2, "Limbi straine"),
            (3, "Fizica si Inginerie"),
            (4, "Drept")
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('
            DELETE FROM faculty;
        ');
    }
}
