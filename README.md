# Recruitment Task System

## Přehled

Symfony 7.3 aplikace s PostgreSQL databází pro recruitment úkoly. Obsahuje 4 komponenty s připravenými daty: Header, Hero, CardBlock a Accordion.

## Instalace a spuštění

1. Pokud není nainstalováno, [nainstalovat Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Spustit `docker compose build --pull --no-cache` pro vytvoření nových obrazů
3. Spustit `docker compose up --wait` pro nastavení a spuštění Symfony projektu
4. Otevřít `https://localhost` v prohlížeči a [přijmout automaticky generovaný TLS certifikát](https://stackoverflow.com/a/15076602/1352334)
5. Spustit `docker compose down --remove-orphans` pro zastavení Docker kontejnerů

## Databázová struktura

### Uživatelé a role

**Tabulky:** `users`, `roles`, `user_roles`

**Entity:** `User`, `Role` (Many-to-Many vztah)

- **User**: email, first_name, last_name, phone, is_active, created_at, updated_at
- **Role**: name, description, is_active, created_at

### Menu a navigace

**Tabulka:** `menu_items`

**Entity:** `MenuItem`

- **MenuItem**: name, url, target, order_index, is_active, created_at, updated_at

### Hero sekce

**Tabulka:** `heroes`

**Entity:** `Hero`

- **Hero**: background_image, title, text, is_active, created_at, updated_at

### Card bloky

**Tabulky:** `card_blocks`, `cards`

**Entity:** `CardBlock`, `Card` (OneToMany vztah)

- **CardBlock**: title, is_active, created_at, updated_at
- **Card**: image, title, text, link_url, order_index, is_active, card_block_id

### FAQ a accordion

**Tabulky:** `accordion_blocks`, `faqs`, `faq_categories`, `faq_faq_categories`

**Entity:** `AccordionBlock`, `Faq`, `FaqCategory` (Many-to-Many vztah)

- **AccordionBlock**: title, description, is_active, created_at, updated_at
- **Faq**: question, answer, slug, order_index, is_active, view_count, is_featured, created_at, updated_at
- **FaqCategory**: name, slug, description, color, order_index, is_active, created_at, updated_at

## Technické požadavky

- PHP 8.4+
- Symfony 7.3
- PostgreSQL 16
- Docker Compose

## API a routing

- `/` - Homepage s komponenty
- `/faq` - FAQ přehled
- `/faq/kategorie/{slug}` - FAQ podle kategorií
- `/faq/{slug}` - Detail FAQ

## Testování

`docker compose exec php php bin/phpunit`

## Deployment

Docker kontejnery s FrankenPHP a PostgreSQL.

## Licence

MIT
