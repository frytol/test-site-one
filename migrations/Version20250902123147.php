<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250902123147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Naplnění tabulek card_blocks a cards testovacími daty pro CardBlock komponentu';
    }

    public function up(Schema $schema): void
    {
        // Insert card block first
        $this->addSql("INSERT INTO card_blocks (id, title, is_active, created_at) VALUES
            (1, 'Naše nejlepší články', true, NOW());
        ");

        // Insert cards with external links
        $this->addSql("INSERT INTO cards (image, title, text, link_url, order_index, is_active, created_at, card_block_id) VALUES
            ('card1.jpg', 'Jak na moderní webdesign', 'Objevte nejnovější trendy a techniky v oblasti webdesignu. Naučte se vytvářet krásné a funkční webové stránky.', 'https://www.google.com', 1, true, NOW(), 1),
            ('card2.jpg', 'Tipy pro SEO optimalizaci', 'Zlepšete viditelnost vašeho webu ve vyhledávačích pomocí našich ověřených SEO strategií a technik.', 'https://www.seznam.cz', 2, true, NOW(), 1),
            ('card3.jpg', 'Budoucnost e-commerce', 'Podívejte se, jak se vyvíjí online obchod a jaké technologie budou klíčové v následujících letech.', 'https://www.siteone.cz', 3, true, NOW(), 1),
            ('card4.jpg', 'JavaScript pro začátečníky', 'Začněte svou cestu v programování s JavaScriptem. Praktické příklady a jednoduché vysvětlení základů.', 'https://www.w3schools.com', 4, true, NOW(), 1);
        ");

        // Reset sequence to continue from next available ID
        $this->addSql("SELECT setval('card_blocks_id_seq', (SELECT MAX(id) FROM card_blocks))");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM cards');
        $this->addSql('DELETE FROM card_blocks');
    }
}
