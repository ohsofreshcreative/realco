/*--- GŁÓWNE IMPORTY ---*/
import Alpine from 'alpinejs';
import fslightbox from 'fslightbox';

// Ustawienie fslightbox globalnie, aby był dostępny
window.fslightbox = fslightbox;

// Importy zasobów dla Vite
import.meta.glob(['../images/**', '../fonts/**']);

// Twoje niestandardowe moduły JS
import './menubar.js';
import './footer-accordion.js';

/*--- NOT USED ---*/
import './blocks/works.js';
import './blocks/category-posts.js';
import './blocks/how.js';
import './blocks/overlap.js';
import './blocks/calc.js';
import './blocks/category-slider.js';

/*--- INICJALIZACJA BIBLIOTEK ---*/
window.Alpine = Alpine;
Alpine.start();
gsap.registerPlugin(ScrollTrigger);

/*--- GŁÓWNY SKRYPT URUCHAMIANY PO ZAŁADOWANIU STRONY ---*/
document.addEventListener('DOMContentLoaded', function () {
  console.log('--- START DIAGNOSTYKI LIGHTBOXA ---');

  // 1. Dynamiczne importy bloków
  if (document.querySelector('.b-info')) import('./blocks/info');
  if (document.querySelector('.b-help')) import('./blocks/help');
  if (document.querySelector('.b-team')) import('./blocks/team');
  if (document.querySelector('.b-reviews')) import('./blocks/reviews');
  if (document.querySelector('.b-places')) import('./blocks/places');
  if (document.querySelector('.b-tabs')) import('./blocks/tabs');
  if (document.querySelector('.b-about')) import('./blocks/about');
  if (document.querySelector('.b-hero')) import('./blocks/hero');
  if (document.querySelector('.b-values')) import('./blocks/values');
  if (document.querySelector('.b-gallery')) import('./blocks/gallery');
  if (document.querySelector('.b-architecture')) import('./blocks/architecture');

  // 2. Diagnostyka FsLightbox
  setTimeout(() => {
    console.log('[DIAGNOSTYKA] Uruchamiam po 500ms...');

    // Sprawdzenie #1: Czy fslightbox jest w ogóle załadowany?
    if (window.fslightbox) {
      console.log('%c[OK] fslightbox jest załadowany i dostępny w `window`.', 'color: green');
    } else {
      console.error('%c[BŁĄD] fslightbox nie został znaleziony w `window`!', 'color: red');
      return; // Kończymy, jeśli nie ma biblioteki
    }

    // Sprawdzenie #2: Czy na stronie istnieją linki, które powinien obsłużyć lightbox?
    const lightboxLinks = document.querySelectorAll('a[data-fslightbox]');
    if (lightboxLinks.length > 0) {
      console.log(`%c[OK] Znaleziono ${lightboxLinks.length} linków z atrybutem [data-fslightbox].`, 'color: green');
      console.log('Oto one:', lightboxLinks);
    } else {
      console.warn('%c[UWAGA] Nie znaleziono żadnych linków z atrybutem [data-fslightbox] na stronie.', 'color: orange');
    }

    // Sprawdzenie #3: Próba ręcznego odświeżenia
    try {
      // Wersja dla PRO (może zadziałać, jeśli jest błąd w dokumentacji)
      if (typeof window.fslightbox.refresh === 'function') {
         window.fslightbox.refresh();
         console.log('[DIAGNOSTYKA] Uruchomiono fslightbox.refresh() (wersja Pro).');
      }
      // Wersja dla FREE (obejście)
      else if (window.fslightbox.instances) {
        for (const key in window.fslightbox.instances) {
          window.fslightbox.instances[key].props.sources = [];
          window.fslightbox.instances[key].handleReceivedSources();
        }
        console.log('[DIAGNOSTYKA] Ręcznie odświeżono instancje fslightbox (wersja Free).');
      } else {
         console.warn('[DIAGNOSTYKA] Nie można było odświeżyć lightboxa - brak metody refresh() i obiektu instances.');
      }
    } catch (e) {
      console.error('[BŁĄD] Wystąpił błąd podczas próby odświeżenia fslightbox:', e);
    }
    
    console.log('--- KONIEC DIAGNOSTYKI LIGHTBOXA ---');

  }, 500); // Zwiększone opóźnienie dla pewności

  // 3. Inicjalizacja GSAP
  if (typeof gsap === 'undefined') {
    console.error('GSAP nie został załadowany.');
    return;
  }

  // Animacje GSAP dla sekcji
  gsap.utils.toArray("[data-gsap-anim='section']").forEach((section) => {
    const standardImages = section.querySelectorAll(
      "[data-gsap-element='img']"
    );
    standardImages.forEach((img) => {
      gsap.from(img, {
        opacity: 0,
        y: 50,
        filter: 'blur(15px)',
        duration: 1,
        ease: 'power2.out',
        scrollTrigger: {
          trigger: img,
          start: 'top 90%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    });

    const otherElements = section.querySelectorAll(
      "[data-gsap-element]:not([data-gsap-element*='img']):not([data-gsap-element='stagger'])"
    );
    otherElements.forEach((element, index) => {
      gsap.from(element, {
        opacity: 0,
        y: 50,
        filter: 'blur(15px)',
        duration: 1,
        ease: 'power2.out',
        delay: index * 0.1,
        scrollTrigger: {
          trigger: element,
          start: 'top 90%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    });

    const staggerElements = section.querySelectorAll(
      "[data-gsap-element='stagger']"
    );
    if (staggerElements.length > 0) {
      const sorted = [...staggerElements].sort((a, b) => {
        const getDelay = (el) => {
          const attr = el.getAttribute('data-gsap-edit');
          return attr && attr.startsWith('delay-')
            ? parseFloat(attr.replace('delay-', '')) || 0
            : 0;
        };
        return getDelay(a) - getDelay(b);
      });

      gsap.set(sorted, { opacity: 0, y: 50 });

      gsap.to(sorted, {
        opacity: 1,
        y: 0,
        filter: 'blur(0px)',
        duration: 1,
        ease: 'power2.out',
        stagger: { amount: 1.5, each: 0.1 },
        scrollTrigger: {
          trigger: section,
          start: 'top 80%',
          toggleActions: 'play none none none',
          once: true,
        },
      });
    }
  });

  // Animacja linii
  const line = document.querySelector('.animated-line');
  if (line) {
    const length = line.getTotalLength();
    gsap.set(line, {
      strokeDasharray: length,
      strokeDashoffset: length,
    });
    gsap.to(line, {
      strokeDashoffset: 0,
      duration: 0.5,
      ease: 'power1.inOut',
      scrollTrigger: {
        trigger: line,
        start: 'top 80%',
        end: 'bottom 20%',
        toggleActions: 'play none none none',
      },
    });
  }
});



