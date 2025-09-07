<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250820093544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Naplnění FAQ systému testovacími daty - kategorie a 20+ FAQ položek';
    }

    public function up(Schema $schema): void
    {
        // Vložení kategorií FAQ
        $this->addSql("INSERT INTO faq_categories (name, slug, description, color, order_index, is_active, created_at) VALUES 
            ('Obecné otázky', 'obecne-otazky', 'Základní informace o naší službě', '#007bff', 1, true, NOW()),
            ('Technická podpora', 'technicka-podpora', 'Řešení technických problémů', '#28a745', 2, true, NOW()),
            ('Platby a ceny', 'platby-a-ceny', 'Informace o cenách a platebních podmínkách', '#ffc107', 3, true, NOW()),
            ('Uživatelské účty', 'uzivatelske-ucty', 'Správa uživatelských účtů a profilů', '#17a2b8', 4, true, NOW()),
            ('Bezpečnost', 'bezpecnost', 'Bezpečnostní otázky a ochrana dat', '#dc3545', 5, true, NOW()),
            ('Funkce aplikace', 'funkce-aplikace', 'Využívání funkcí a možností aplikace', '#6f42c1', 6, true, NOW())
        ");

        // Vložení FAQ položek
        $this->addSql("INSERT INTO faqs (question, slug, answer, order_index, is_active, view_count, created_at) VALUES 
            ('Co je to vaše služba?', 'co-je-to-vase-sluzba', 'Naše služba je moderní webová aplikace, která umožňuje efektivní správu projektů a týmovou spolupráci. Poskytujeme intuitivní rozhraní pro organizaci úkolů, komunikaci v týmu a sledování pokroku.', 1, true, 0, NOW()),
            ('Jak se mohu zaregistrovat?', 'jak-se-mohu-zaregistrovat', 'Registrace je velmi jednoduchá. Klikněte na tlačítko \"Registrovat\" v pravém horním rohu, vyplňte základní údaje (email, jméno, heslo) a potvrďte registraci prostřednictvím emailu.', 2, true, 0, NOW()),
            ('Je vaše služba zdarma?', 'je-vase-sluzba-zdarma', 'Nabízíme základní plán zdarma pro malé týmy do 5 uživatelů. Pro větší týmy a pokročilé funkce máme prémiové plány od 299 Kč měsíčně.', 3, true, 0, NOW()),
            ('Podporujete mobilní aplikace?', 'podporujete-mobilni-aplikace', 'Ano, máme nativní mobilní aplikace pro iOS i Android. Aplikace jsou dostupné v App Store a Google Play Store zdarma.', 4, true, 0, NOW()),
            ('Jak dlouho trvá implementace?', 'jak-dlouho-trva-implementace', 'Standardní implementace trvá 1-2 týdny v závislosti na složitosti vašich požadavků. Náš tým vám pomůže s migrací dat a školením uživatelů.', 5, true, 0, NOW()),
            
            ('Nefunguje mi přihlášení, co mám dělat?', 'nefunguje-mi-prihlaseni-co-mam-delat', 'Zkuste nejprve obnovit heslo pomocí odkazu \"Zapomenuté heslo\". Pokud problém přetrvává, kontaktujte naši technickou podporu na support@example.com.', 1, true, 0, NOW()),
            ('Mohu změnit své uživatelské jméno?', 'mohu-zmenit-sve-uzivatelske-jmeno', 'Uživatelské jméno lze změnit v nastavení profilu. Přejděte do Můj profil > Nastavení > Osobní údaje a upravte požadované informace.', 2, true, 0, NOW()),
            ('Jak mohu exportovat svá data?', 'jak-mohu-exportovat-sva-data', 'Data můžete exportovat v sekci Nastavení > Export dat. Podporujeme formáty CSV, JSON a PDF. Export může trvat několik minut v závislosti na množství dat.', 3, true, 0, NOW()),
            ('Proč se mi stránka načítá pomalu?', 'proc-se-mi-stranka-nacita-pomalu', 'Pomalé načítání může být způsobeno internetním připojením nebo vysokou zátěží serveru. Zkuste vymazat cache prohlížeče nebo použít jinou síť.', 4, true, 0, NOW()),
            ('Podporujete integraci s jinými nástroji?', 'podporujete-integraci-s-jinymi-nastroji', 'Ano, podporujeme integraci s populárními nástroji jako Slack, Trello, GitHub, Google Drive a mnoho dalších prostřednictvím našeho API.', 5, true, 0, NOW()),
            
            ('Jaké jsou vaše platební metody?', 'jake-jsou-vase-platebni-metody', 'Přijímáme platby kartou (Visa, MasterCard), bankovním převodem, PayPal a kryptoměny (Bitcoin, Ethereum). Všechny platby jsou zabezpečené SSL šifrováním.', 1, true, 0, NOW()),
            ('Mohu zrušit předplatné kdykoliv?', 'mohu-zrusit-predplatne-kdykoliv', 'Ano, předplatné můžete zrušit kdykoliv bez sankcí. Po zrušení zůstane účet aktivní do konce zaplacené periode.', 2, true, 0, NOW()),
            ('Nabízíte slevy pro studenty?', 'nabizite-slevy-pro-studenty', 'Ano, studenti s platným průkazem mohou získat 50% slevu na všechny prémiové plány. Kontaktujte nás pro ověření studentského statutu.', 3, true, 0, NOW()),
            ('Jak funguje fakturace?', 'jak-funguje-fakturace', 'Faktury zasíláme automaticky na váš email na začátku každého fakturačního období. V účtu můžete nastavit fakturační údaje a stáhnout předchozí faktury.', 4, true, 0, NOW()),
            ('Je možné upgradovat plán uprostřed období?', 'je-mozne-upgradovat-plan-uprostred-obdobi', 'Ano, plán můžete kdykoliv upgradovat. Rozdíl v ceně se propočítá poměrně a bude účtován na vaší další faktuře.', 5, true, 0, NOW()),
            
            ('Jak resetuji své heslo?', 'jak-resetuji-sve-heslo', 'Na přihlašovací stránce klikněte na \"Zapomenuté heslo\", zadejte email a následujte instrukce v emailu pro vytvoření nového hesla.', 1, true, 0, NOW()),
            ('Mohu mít více účtů se stejným emailem?', 'mohu-mit-vice-uctu-se-stejnym-emailem', 'Ne, každý email může být použit pouze pro jeden účet. Pokud potřebujete více účtů, použijte různé emailové adresy.', 2, true, 0, NOW()),
            ('Jak smažu svůj účet?', 'jak-smazu-svuj-ucet', 'Účet můžete smazat v nastavení profilu pod sekci \"Nebezpečná zóna\". Upozorňujeme, že smazání je nevratné a všechna data budou ztracena.', 3, true, 0, NOW()),
            ('Co se stane s mými daty při smazání účtu?', 'co-se-stane-s-mymi-daty-pri-smazani-uctu', 'Při smazání účtu jsou všechna vaše data trvale odstraněna z našich serverů do 30 dnů. Doporučujeme před smazáním exportovat důležitá data.', 4, true, 0, NOW()),
            
            ('Jak zabezpečujete moje data?', 'jak-zabezpecujete-moje-data', 'Používáme špičkové bezpečnostní standardy včetně AES-256 šifrování, SSL certifikátů, pravidelných bezpečnostních auditů a GDPR compliance.', 1, true, 0, NOW()),
            ('Můžu nastavit dvoufaktorovou autentizaci?', 'muzu-nastavit-dvoufaktorovou-autentizaci', 'Ano, dvoufaktorovou autentizaci najdete v nastavení bezpečnosti. Podporujeme Google Authenticator, SMS kódy a hardwarové klíče.', 2, true, 0, NOW()),
            ('Kde se nacházejí vaše servery?', 'kde-se-nachazejí-vase-servery', 'Naše primární servery se nacházejí v datových centrech v EU (Frankfurt, Amsterdam) s vysokou dostupností a redundancí pro zajištění ochrany dat.', 3, true, 0, NOW()),
            
            ('Jak mohu sdílet projekt s týmem?', 'jak-mohu-sdilet-projekt-s-tymem', 'V detailu projektu klikněte na \"Sdílet\", zadejte emailové adresy členů týmu a nastavte jejich oprávnění (prohlížení, úpravy, administrace).', 1, true, 0, NOW()),
            ('Podporujete offline režim?', 'podporujete-offline-rezim', 'Ano, naše mobilní aplikace umožňují základní funkce i offline. Data se synchronizují automaticky po obnovení internetového připojení.', 2, true, 0, NOW()),
            ('Mohu přizpůsobit rozhraní aplikace?', 'mohu-prizpusobit-rozhrani-aplikace', 'Ano, v nastavení můžete změnit barevné téma, rozložení panelů, jazyk rozhraní a další personalizační možnosti pro lepší uživatelský zážitek.', 3, true, 0, NOW())
        ");

        // Přiřazení FAQ do kategorií (Many-to-Many vztahy)
        $this->addSql("
            INSERT INTO faq_faq_categories (faq_id, faq_category_id) 
            SELECT f.id, c.id FROM faqs f, faq_categories c 
            WHERE f.slug IN ('co-je-to-vase-sluzba', 'jak-se-mohu-zaregistrovat', 'je-vase-sluzba-zdarma', 'podporujete-mobilni-aplikace', 'jak-dlouho-trva-implementace') 
            AND c.slug = 'obecne-otazky'
        ");
        
        $this->addSql("
            INSERT INTO faq_faq_categories (faq_id, faq_category_id) 
            SELECT f.id, c.id FROM faqs f, faq_categories c 
            WHERE f.slug IN ('nefunguje-mi-prihlaseni-co-mam-delat', 'jak-mohu-exportovat-sva-data', 'proc-se-mi-stranka-nacita-pomalu', 'podporujete-integraci-s-jinymi-nastroji') 
            AND c.slug = 'technicka-podpora'
        ");
        
        $this->addSql("
            INSERT INTO faq_faq_categories (faq_id, faq_category_id) 
            SELECT f.id, c.id FROM faqs f, faq_categories c 
            WHERE f.slug IN ('jake-jsou-vase-platebni-metody', 'mohu-zrusit-predplatne-kdykoliv', 'nabizite-slevy-pro-studenty', 'jak-funguje-fakturace', 'je-mozne-upgradovat-plan-uprostred-obdobi') 
            AND c.slug = 'platby-a-ceny'
        ");
        
        $this->addSql("
            INSERT INTO faq_faq_categories (faq_id, faq_category_id) 
            SELECT f.id, c.id FROM faqs f, faq_categories c 
            WHERE f.slug IN ('jak-resetuji-sve-heslo', 'mohu-mit-vice-uctu-se-stejnym-emailem', 'jak-smazu-svuj-ucet', 'co-se-stane-s-mymi-daty-pri-smazani-uctu', 'mohu-zmenit-sve-uzivatelske-jmeno') 
            AND c.slug = 'uzivatelske-ucty'
        ");
        
        $this->addSql("
            INSERT INTO faq_faq_categories (faq_id, faq_category_id) 
            SELECT f.id, c.id FROM faqs f, faq_categories c 
            WHERE f.slug IN ('jak-zabezpecujete-moje-data', 'muzu-nastavit-dvoufaktorovou-autentizaci', 'kde-se-nachazejí-vase-servery') 
            AND c.slug = 'bezpecnost'
        ");
        
        $this->addSql("
            INSERT INTO faq_faq_categories (faq_id, faq_category_id) 
            SELECT f.id, c.id FROM faqs f, faq_categories c 
            WHERE f.slug IN ('jak-mohu-sdilet-projekt-s-tymem', 'podporujete-offline-rezim', 'mohu-prizpusobit-rozhrani-aplikace', 'podporujete-integraci-s-jinymi-nastroji') 
            AND c.slug = 'funkce-aplikace'
        ");
        
        // Některá FAQ přiřadíme do více kategorií
        $this->addSql("
            INSERT INTO faq_faq_categories (faq_id, faq_category_id) 
            SELECT f.id, c.id FROM faqs f, faq_categories c 
            WHERE f.slug = 'je-vase-sluzba-zdarma' AND c.slug = 'platby-a-ceny'
        ");
        
        $this->addSql("
            INSERT INTO faq_faq_categories (faq_id, faq_category_id) 
            SELECT f.id, c.id FROM faqs f, faq_categories c 
            WHERE f.slug = 'jak-resetuji-sve-heslo' AND c.slug = 'technicka-podpora'
        ");
    }

    public function down(Schema $schema): void
    {
        // Vymazání testovacích dat
        $this->addSql('DELETE FROM faq_faq_categories');
        $this->addSql('DELETE FROM faqs');
        $this->addSql('DELETE FROM faq_categories');
    }
}
