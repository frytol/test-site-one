<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250902121408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Naplnění tabulky heroes testovacími daty pro Hero komponentu';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO heroes (background_image, title, text, is_active, created_at) VALUES
            ('hero-bg.jpg', 'Vítejte v SiteOne', 'Objevte nejnovější trendy a inovace, které formují budoucnost digitálního světa. Jsme tu, abychom vás provedli cestou k úspěchu.', true, NOW())
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM heroes');
    }
}
