import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';

document.querySelectorAll('.architecture-slider').forEach((slider) => {
  new Swiper(slider, {
    modules: [Navigation],
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    navigation: {
      nextEl: slider.querySelector('.swiper-button-next'),
      prevEl: slider.querySelector('.swiper-button-prev'),
    },
  });
});