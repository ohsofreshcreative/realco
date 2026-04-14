import Swiper from 'swiper';
import { Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

document.querySelectorAll('.hero-slider').forEach((slider) => {
  new Swiper(slider, {
    modules: [Pagination],
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    pagination: {
      el: slider.querySelector('.swiper-pagination'),
      clickable: true,
    },
  });
});