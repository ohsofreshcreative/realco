import Swiper from 'swiper';
import { Pagination, Autoplay } from 'swiper/modules'; // <-- Dodaj Autoplay
import 'swiper/css';
import 'swiper/css/pagination';

document.querySelectorAll('.hero-slider').forEach((slider) => {
  new Swiper(slider, {
    modules: [Pagination, Autoplay], // <-- Dodaj Autoplay do modułów
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    autoplay: {
      delay: 5000,
    },
    pagination: {
      el: slider.querySelector('.swiper-pagination'),
      clickable: true,
    },
  });
});