import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';

const initArchitectureSlider = () => {
  const sliders = document.querySelectorAll('.architecture-slider');

  if (!sliders.length) {
    return;
  }

  sliders.forEach((slider) => {
    const nextEl = slider.querySelector('.swiper-button-next');
    const prevEl = slider.querySelector('.swiper-button-prev');

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
};

export default initArchitectureSlider;