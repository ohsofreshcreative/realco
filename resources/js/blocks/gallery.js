import Swiper from 'swiper';
// 1. Zaimportuj moduł Pagination
import { Navigation, Pagination } from 'swiper/modules'; 
// 2. Zaimportuj style dla paginacji
import 'swiper/css/pagination';

function initializeGalleries() {
  const galleryContainers = document.querySelectorAll('.gallery-tabs-container');

  galleryContainers.forEach((container) => {
    const tabButtons = container.querySelectorAll('.swiper-tab-button');
    const mainSwiperEl = container.querySelector('.gallery-tabs-swiper');
    
    if (!mainSwiperEl || tabButtons.length === 0) {
      return;
    }

    const mainSwiper = new Swiper(mainSwiperEl, {
      autoHeight: true,
      spaceBetween: 20,
      allowTouchMove: false, 
      on: {
        slideChange: function () {
          const activeIndex = this.activeIndex;
          tabButtons.forEach((button, index) => {
            button.classList.toggle('active', index === activeIndex);
          });
        },
      },
    });

    tabButtons.forEach((button) => {
      button.addEventListener('click', () => {
        const index = parseInt(button.getAttribute('data-index'));
        mainSwiper.slideTo(index);
      });
    });

    const gallerySliders = container.querySelectorAll('.gallery-slider');
    gallerySliders.forEach((slider) => {
      new Swiper(slider, {
        // 3. Dodaj Pagination do modułów
        modules: [Navigation, Pagination], 
        navigation: {
          nextEl: slider.querySelector('.swiper-button-next'),
          prevEl: slider.querySelector('.swiper-button-prev'),
        },
        // 4. Dodaj konfigurację paginacji
        pagination: {
          el: slider.querySelector('.swiper-pagination'), // Szukaj wewnątrz konkretnego slidera
          clickable: true,
        },
        slidesPerView: 1,
        spaceBetween: 10,
      });
    });
  });
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeGalleries);
} else {
  initializeGalleries();
}

if (window.acf) {
  window.acf.addAction('render_block_preview', initializeGalleries);
}