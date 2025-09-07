<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250902114917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Naplnění tabulky menu_items testovacími daty pro navigaci';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO menu_items (name, url, order_index, target, is_active, created_at) VALUES
            ('Domů', '/', 1, '_self', true, NOW()),
            ('O nás', '#', 2, '_self', true, NOW()),
            ('Články', '#', 3, '_self', true, NOW()),
            ('FAQ', '#', 4, '_self', true, NOW()),
            ('Kontakt', '#', 4, '_self', true, NOW())
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM menu_items');
    }
}
