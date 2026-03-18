// resources/js/blocks/hero.js

import Swiper from 'swiper';
import { Autoplay, EffectFade, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/pagination';

const heroSlider = new Swiper('.hero-slider', {
  modules: [Autoplay, EffectFade, Pagination],
  loop: true,
  effect: 'fade',
  
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },

  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
});