<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250902130201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Naplnění accordion_blocks a označení FAQ jako featured pro Accordion komponentu';
    }

    public function up(Schema $schema): void
    {
        // Insert accordion block
        $this->addSql("INSERT INTO accordion_blocks (id, title, description, is_active, created_at) VALUES 
            (1, 'Nejčastější otázky', 'Odpovědi na otázky, které nás nejčastěji oslavíte. Pokud nenajdete to, co hledáte, neváhejte nás kontaktovat.', true, NOW())
        ");

        // Mark some existing FAQs as featured (update first 5 FAQs)
        $this->addSql("UPDATE faqs SET is_featured = true WHERE id IN (
            SELECT id FROM (
                SELECT id FROM faqs WHERE is_active = true ORDER BY id LIMIT 5
            ) AS subquery
        )");
        
        // Reset sequence to continue from next available ID
        $this->addSql("SELECT setval('accordion_blocks_id_seq', (SELECT MAX(id) FROM accordion_blocks))");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM accordion_blocks');
        $this->addSql('UPDATE faqs SET is_featured = false WHERE is_featured = true');
    }
}
