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
document.addEventListener('DOMContentLoaded', () => {
  // Dynamiczne ładowanie skryptów dla bloków
  if (document.querySelector('.b-help')) import('./blocks/help');
  if (document.querySelector('.b-team')) import('./blocks/team');
  if (document.querySelector('.b-reviews')) import('./blocks/reviews');
  if (document.querySelector('.b-places')) import('./blocks/places');
  if (document.querySelector('.b-tabs')) import('./blocks/tabs');
  if (document.querySelector('.b-about')) import('./blocks/about');
  if (document.querySelector('.b-hero')) import('./blocks/hero');
  if (document.querySelector('.b-values')) import('./blocks/values');
  if (document.querySelector('.b-gallery')) import('./blocks/gallery');
  if (document.querySelector('.b-info')) import('./blocks/info');
  if (document.querySelector('.b-architecture')) import('./blocks/architecture');

  // Inicjalizacja baguetteBox.js - teraz zadziała, bo skrypt jest ładowany przez WP
  if (typeof baguetteBox !== 'undefined' && document.querySelector('.lightbox-gallery')) {
    baguetteBox.run('.lightbox-gallery');
  }

  // Inicjalizacja animacji GSAP
  if (typeof gsap === 'undefined') {
    console.error('GSAP nie został załadowany globalnie.');
    return;
  }
  gsap.registerPlugin(ScrollTrigger);

  // ... (reszta kodu GSAP bez zmian)
  gsap.utils.toArray("[data-gsap-anim='section']").forEach((section) => {
    const standardImages = section.querySelectorAll("[data-gsap-element='img']");
    standardImages.forEach((img) => {
      gsap.from(img, {
        opacity: 0, y: 50, filter: 'blur(15px)', duration: 1, ease: 'power2.out',
        scrollTrigger: { trigger: img, start: 'top 90%', toggleActions: 'play none none none', once: true },
      });
    });
    const otherElements = section.querySelectorAll("[data-gsap-element]:not([data-gsap-element*='img']):not([data-gsap-element='stagger'])");
    otherElements.forEach((element, index) => {
      gsap.from(element, {
        opacity: 0, y: 50, filter: 'blur(15px)', duration: 1, ease: 'power2.out', delay: index * 0.1,
        scrollTrigger: { trigger: element, start: 'top 90%', toggleActions: 'play none none none', once: true },
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
        opacity: 1, y: 0, filter: 'blur(0px)', duration: 1, ease: 'power2.out', stagger: { amount: 1.5, each: 0.1 },
        scrollTrigger: { trigger: section, start: 'top 80%', toggleActions: 'play none none none', once: true },
      });
    }
  });
  const line = document.querySelector('.animated-line');
  if (line) {
    const length = line.getTotalLength();
    gsap.set(line, { strokeDasharray: length, strokeDashoffset: length });
    gsap.to(line, {
      strokeDashoffset: 0, duration: 0.5, ease: 'power1.inOut',
      scrollTrigger: { trigger: line, start: 'top 80%', end: 'bottom 20%', toggleActions: 'play none none none' },
    });
  }
});