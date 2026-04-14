/*--- GŁÓWNE IMPORTY ---*/
import Alpine from 'alpinejs';
import.meta.glob(['../images/**', '../fonts/**']);
import './menubar.js';
import './footer-accordion.js';

/*--- NIEUŻYWANE (ale wciąż importowane) ---*/
import './blocks/works.js';
import './blocks/category-posts.js';
import './blocks/how.js';
import './blocks/overlap.js';
import './blocks/calc.js';
import './blocks/category-slider.js';

/*--- INICJALIZACJA BIBLIOTEK ---*/
window.Alpine = Alpine;
Alpine.start();

/*--- GŁÓWNY SKRYPT URUCHAMIANY PO ZAŁADOWANIU STRONY ---*/
document.addEventListener('DOMContentLoaded', async () => {
  // 1. Dynamiczne ładowanie skryptów dla bloków, które istnieją na stronie
  const blockImports = [
    { selector: '.b-help', path: './blocks/help' },
    { selector: '.b-team', path: './blocks/team' },
    { selector: '.b-reviews', path: './blocks/reviews' },
    { selector: '.b-places', path: './blocks/places' },
    { selector: '.b-tabs', path: './blocks/tabs' },
    { selector: '.b-about', path: './blocks/about' },
    { selector: '.b-hero', path: './blocks/hero' },
    { selector: '.b-values', path: './blocks/values' },
    { selector: '.b-gallery', path: './blocks/gallery' },
    { selector: '.b-info', path: './blocks/info' },
    { selector: '.b-architecture', path: './blocks/architecture' },
  ];

  const promises = blockImports
    .filter(block => document.querySelector(block.selector))
    .map(block => import(block.path));

  // Czekamy, aż wszystkie dynamiczne skrypty się załadują
  await Promise.all(promises);

  // 2. Inicjalizacja baguetteBox.js (teraz mamy pewność, że DOM jest gotowy)
  if (typeof baguetteBox !== 'undefined' && document.querySelector('.lightbox-gallery')) {
    baguetteBox.run('.lightbox-gallery');
  } else if (document.querySelector('.lightbox-gallery')) {
    console.error('baguetteBox nie jest zdefiniowany. Sprawdź, czy skrypt jest poprawnie załadowany.');
  }

  // 3. Inicjalizacja animacji GSAP
  if (typeof gsap === 'undefined') {
    console.error('GSAP nie został załadowany globalnie. Sprawdź plik app/setup.php lub functions.php');
    return; // Zakończ, jeśli GSAP nie istnieje
  }

  gsap.registerPlugin(ScrollTrigger);

  // Animacje dla elementów [data-gsap-anim='section']
  gsap.utils.toArray("[data-gsap-anim='section']").forEach((section) => {
    const standardImages = section.querySelectorAll("[data-gsap-element='img']");
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

    const otherElements = section.querySelectorAll("[data-gsap-element]:not([data-gsap-element*='img']):not([data-gsap-element='stagger'])");
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

    const staggerElements = section.querySelectorAll("[data-gsap-element='stagger']");
    if (staggerElements.length > 0) {
      const sorted = [...staggerElements].sort((a, b) => {
        const getDelay = (el) => {
          const attr = el.getAttribute('data-gsap-edit');
          return attr && attr.startsWith('delay-') ? parseFloat(attr.replace('delay-', '')) || 0 : 0;
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

  // Animacja dla .animated-line
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