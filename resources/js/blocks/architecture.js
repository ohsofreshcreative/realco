import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';

const initArchitectureSlider = () => {
  const sliders = document.querySelectorAll('.architecture-slider');

  if (!sliders.length) {
    return;
  }

  sliders.forEach((slider) => {
    new Swiper(slider, {
      modules: [Navigation],
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  });
};

export default initArchitectureSlider;