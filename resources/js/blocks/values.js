// resources/js/blocks/values.js

import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';

const valuesSlider = new Swiper('.values-slider', {
  modules: [Navigation],
  
  // Navigation arrows
  navigation: {
    nextEl: '.swiper-navigation-values .swiper-button-next',
    prevEl: '.swiper-navigation-values .swiper-button-prev',
  },

  // Responsive breakpoints
  slidesPerView: 1.2,
  spaceBetween: 16,
  breakpoints: {
    // when window width is >= 768px
    768: {
      slidesPerView: 2.7,
      spaceBetween: 32
    },
    // when window width is >= 1024px
    1024: {
      slidesPerView: 3.4,
      spaceBetween: 32
    },
    // when window width is >= 1280px
    1280: {
        slidesPerView: 3.9,
        spaceBetween: 32
    }
  }
});