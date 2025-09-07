/**
 * JavaScript pro interaktivní komponenty
 * Implementujte funkčnost hamburger menu a accordion
 * 
 * Implementujte:
 * 1. Hamburger menu toggle pro mobilní zobrazení (header komponenta)
 * 2. Accordion funkčnost pro FAQ (accordion komponenta)
 *    - Klik na otázku otevře/zavře odpověď
 *    - Pouze jedna odpověď otevřená najednou (nebo více podle designu)
 *    - Smooth animace při otevírání/zavírání
 *    - Příslušné ARIA atributy pro přístupnost
 */

// Controller for Hamburger
document.addEventListener('DOMContentLoaded', function () {
    const hamburger = document.querySelector('.hamburger')
    const nav = document.querySelector('.header__nav')
    const body = document.body
    const html = document.documentElement
    const navLinks = nav.querySelectorAll('a')

    function isMobile() {
        return window.matchMedia('(max-width: 767px)').matches;
    }

    function resetNoScroll() {
        body.classList.remove('no-scroll')
        html.classList.remove('no-scroll')
    }

    // Init type menu
    function initMenu() {
        if (isMobile()) {
            nav.classList.remove('open')
            hamburger.setAttribute('aria-expanded', 'false')
            nav.setAttribute('aria-hidden', 'true')
            navLinks.forEach(link => link.setAttribute('tabindex', '-1'))
            resetNoScroll()
        } else {
            nav.classList.remove('open')
            hamburger.setAttribute('aria-expanded', null)
            nav.setAttribute('aria-hidden', null)
            navLinks.forEach(link => link.removeAttribute('tabindex'))
            resetNoScroll()
        }
    }

    hamburger.addEventListener('click', function () {
        if (!isMobile()) return

        const isOpen = hamburger.classList.toggle('open')
        nav.classList.toggle('open')

        hamburger.setAttribute('aria-expanded', isOpen ? 'true' : 'false')
        nav.setAttribute('aria-hidden', isOpen ? 'false' : 'true')

        if (isOpen) {
            navLinks.forEach(link => link.removeAttribute('tabindex'))
            hamburger.setAttribute('aria-label', 'Zavřít menu')
            navLinks[0]?.focus()
            body.classList.add('no-scroll')
            html.classList.add('no-scroll')
        } else {
            navLinks.forEach(link => link.setAttribute('tabindex', '-1'))
            hamburger.setAttribute('aria-label', 'Otevřít menu')
            resetNoScroll()
        }
    })

    window.addEventListener('resize', initMenu)

    initMenu()
})

// Controller for Accordion
document.addEventListener("DOMContentLoaded", () => {
    const accordionItems = document.querySelectorAll(".accordion__item")

    const allowMultipleOpen = true // One or multiple open?

    accordionItems.forEach(item => {
        const trigger = item.querySelector(".accordion__item-question")
        const answer = item.querySelector(".accordion__item-answer")
        const innerContent = answer.querySelector(".accordion__item-answer-content")

        // Styles for animation
        answer.style.maxHeight = item.classList.contains("open") ? innerContent.scrollHeight + "px" : "0"
        answer.style.overflow = "hidden"
        answer.style.transition = "max-height 0.4s ease"

        // ARIA init
        trigger.setAttribute("aria-expanded", item.classList.contains("open"))
        answer.setAttribute("aria-hidden", !item.classList.contains("open"))
        item.setAttribute("aria-expanded", item.classList.contains("open"))

        trigger.addEventListener("click", (event) => {
            event.preventDefault()

            const isOpen = item.classList.contains("open")
            const innerContent = answer.querySelector(".accordion__item-answer-content")

            // Close open item
            if (!allowMultipleOpen) {
                accordionItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains("open")) {
                        otherItem.classList.remove("open")
                        const otherAnswer = otherItem.querySelector(".accordion__item-answer")
                        const otherTrigger = otherItem.querySelector(".accordion__item-question")

                        otherAnswer.style.maxHeight = "0"
                        otherTrigger.setAttribute("aria-expanded", "false")
                        otherAnswer.setAttribute("aria-hidden", "true")
                        otherItem.setAttribute("aria-expanded", "false")
                    }
                })
            }

            // Open or close
            if (isOpen) {
                item.classList.remove("open")
                answer.style.maxHeight = "0"
            } else {
                item.classList.add("open")
                answer.style.maxHeight = innerContent.scrollHeight + "px"
            }

            // ARIA update
            trigger.setAttribute("aria-expanded", String(!isOpen))
            answer.setAttribute("aria-hidden", String(isOpen))
            item.setAttribute("aria-expanded", String(!isOpen))
        })
    })
})