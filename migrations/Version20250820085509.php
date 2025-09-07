<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250820085509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Naplnění tabulek testovacími daty pro uživatele a role';
    }

    public function up(Schema $schema): void
    {
        // Vytvoření rolí
        $this->addSql("INSERT INTO roles (name, description, is_active, created_at) VALUES 
            ('ROLE_ADMIN', 'Administrátor systému s plnými právy', true, NOW()),
            ('ROLE_MANAGER', 'Manažer s rozšířenými právy', true, NOW()),
            ('ROLE_USER', 'Běžný uživatel', true, NOW()),
            ('ROLE_GUEST', 'Host s omezenými právy', true, NOW()),
            ('ROLE_DEVELOPER', 'Vývojář aplikace', true, NOW())
        ");
        
        // Vytvoření uživatelů
        $this->addSql("INSERT INTO users (email, first_name, last_name, phone, is_active, created_at) VALUES 
            ('admin@example.com', 'Jan', 'Novák', '+420123456789', true, NOW()),
            ('manager@example.com', 'Petra', 'Svobodová', '+420987654321', true, NOW()),
            ('user1@example.com', 'Tomáš', 'Dvořák', '+420111222333', true, NOW()),
            ('user2@example.com', 'Eva', 'Procházková', '+420444555666', true, NOW()),
            ('developer@example.com', 'Martin', 'Krejčí', '+420777888999', true, NOW()),
            ('guest@example.com', 'Anna', 'Černá', NULL, true, NOW()),
            ('inactive@example.com', 'Pavel', 'Bílý', '+420666777888', false, NOW()),
            ('test1@example.com', 'Lucie', 'Veselá', '+420333444555', true, NOW()),
            ('test2@example.com', 'Jiří', 'Malý', NULL, true, NOW()),
            ('test3@example.com', 'Lenka', 'Pokorná', '+420222333444', true, NOW())
        ");
        
        // Přiřazení rolí uživatelům
        $this->addSql("INSERT INTO user_roles (user_id, role_id) 
            SELECT u.id, r.id FROM users u, roles r 
            WHERE u.email = 'admin@example.com' AND r.name IN ('ROLE_ADMIN', 'ROLE_USER')
        ");
        
        $this->addSql("INSERT INTO user_roles (user_id, role_id) 
            SELECT u.id, r.id FROM users u, roles r 
            WHERE u.email = 'manager@example.com' AND r.name IN ('ROLE_MANAGER', 'ROLE_USER')
        ");
        
        $this->addSql("INSERT INTO user_roles (user_id, role_id) 
            SELECT u.id, r.id FROM users u, roles r 
            WHERE u.email = 'developer@example.com' AND r.name IN ('ROLE_DEVELOPER', 'ROLE_USER')
        ");
        
        $this->addSql("INSERT INTO user_roles (user_id, role_id) 
            SELECT u.id, r.id FROM users u, roles r 
            WHERE u.email IN ('user1@example.com', 'user2@example.com', 'test1@example.com', 'test2@example.com', 'test3@example.com') 
            AND r.name = 'ROLE_USER'
        ");
        
        $this->addSql("INSERT INTO user_roles (user_id, role_id) 
            SELECT u.id, r.id FROM users u, roles r 
            WHERE u.email = 'guest@example.com' AND r.name = 'ROLE_GUEST'
        ");
        
        $this->addSql("INSERT INTO user_roles (user_id, role_id) 
            SELECT u.id, r.id FROM users u, roles r 
            WHERE u.email = 'inactive@example.com' AND r.name IN ('ROLE_USER', 'ROLE_MANAGER')
        ");
    }

    public function down(Schema $schema): void
    {
        // Vymazání dat z tabulek
        $this->addSql('DELETE FROM user_roles');
        $this->addSql('DELETE FROM users');
        $this->addSql('DELETE FROM roles');
    }
}
