# Zadání - Frontend Developer

## Úvod a kontext

Vítejte u praktického úkolu pro pozici Frontend Developer. Vaším úkolem je implementovat 4 komponenty podle Figma designu pro webovou aplikaci.

Aplikace je připravena v Symfony frameworku s PostgreSQL databází. Všechny potřebné entity, controllery a základní template struktury jsou již implementovány. Vaším úkolem je vytvořit HTML strukturu, CSS stylování a JavaScript funkcionalitu pro jednotlivé komponenty.

Data pro komponenty se načítají z databáze a jsou předána do template jako PHP proměnné. Všechna data najdete připravená v šabloně `templates/homepage/index.html.twig`. Nemusíte řešit backend funkcionalitu.

## Technické požadavky

**CSS:**
- BEM metodologie pro názvy tříd
- Responzivní design (desktop + mobile, breakpoint 480px)
- Bez použití CSS frameworků (Bootstrap, Tailwind atd.)

**JavaScript:**
- Vanilla JavaScript (žádné jQuery, React, Vue atd.)
- Smooth animace při interakcích

**HTML:**
- Sémantické HTML5 elementy
- Validní HTML struktura
- Přístupnost (alt atributy, role, ARIA labely, atd.)

**Obecné:**
- Čistý, čitelný kód s komentáři
- Cross-browser kompatibilita (moderní prohlížeče)
- Optimalizované obrázky a výkon
- Obrázky stáhnout z Figma designu a pojmenovat podle názvů v databázi (logo.svg, card1.jpg, card2.jpg, atd.)

## Komponenty k implementaci

Implementujte následující 4 komponenty podle Figma designu:

1. **Header komponenta** - Navigace s logem a hamburger menu pro mobil
2. **Hero komponenta** - Sekce s background obrázkem a obsahem  
3. **CardBlock komponenta** - Grid karet s obrázky a odkazy
4. **Accordion komponenta** - FAQ sekce s JavaScript funkcionalitou

CSS soubory: `public/css/header.css`, `public/css/hero.css`, `public/css/card-block.css`, `public/css/accordion.css`
JavaScript: `public/js/main.js`

## Hodnotící kritéria

- **Kvalita kódu** - čistý, čitelný kód s dodržením BEM metodologie
- **Funkcionalita** - všechny komponenty fungují podle požadavků
- **Responzivní design** - správné chování na desktop i mobilu
- **Věrnost designu** - soulad s Figma předlohou (co ve Figmě není, to si udělej dle sebe)
- **Přístupnost** - správné použití sémantických elementů a ARIA atributů

## Způsob odevzdání

Kód nahraj do veřejného GitHub repozitáře a pošli nám odkaz.

**Důležité:** Neprováděj fork tohoto repozitáře - tato vazba je na GitHubu veřejně viditelná a mohla by pomáhat ostatním uchazečům. Vytvoř si nový repozitář.

## Časový limit

Orientační čas pro dokončení úkolu je **2 hodiny**. Jedná se o doporučený čas, ne striktní limit.

## Kontakt pro dotazy

jakub.cieslar@siteone.cz, jiri.cerhan@siteone.cz

Dotazy posílej na oba kontakty najednou. 
