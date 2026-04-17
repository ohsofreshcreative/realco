import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation'; // Ważne: Dodaj import stylów dla nawigacji

document.querySelectorAll('.architecture-slider').forEach((slider) => {
  const nextEl = slider.querySelector('.swiper-button-next');
  const prevEl = slider.querySelector('.swiper-button-prev');

  // Sprawdzenie, czy slider ma przyciski nawigacji
  if (!nextEl || !prevEl) {
    console.warn('Slider architecture nie ma przycisków nawigacji.', slider);
    return; // Nie inicjuj Swipera, jeśli brakuje przycisków
  }

  new Swiper(slider, {
    modules: [Navigation],
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    navigation: {
      nextEl: nextEl,
      prevEl: prevEl,
    },
  });
});